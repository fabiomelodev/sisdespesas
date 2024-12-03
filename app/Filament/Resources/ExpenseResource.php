<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Helpers\MonthHelper;
use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\{DatePicker, Repeater, Section, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $label = 'Despesa';

    protected static ?string $pluralLabel = 'Despesas';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('Despesas e Entradas');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Select::make('type')
                    ->label('Tipo')
                    ->default('inconstante')
                    ->required()
                    ->reactive()
                    ->columnSpan(9)
                    ->options([
                        'inconstante' => 'Inconstante',
                        'fixo'       => 'Fixo',
                        'credito'    => 'Crédito'
                    ]),
                Select::make('credit')
                    ->label('Cartão')
                    ->reactive()
                    ->columnSpan(9)
                    ->options([
                        'Itaú 3026' => 'Itaú 3026',
                        'Itaú 6993' => 'Itaú 6993'
                    ])
                    ->hidden(function (Get $get) {
                        if ($get('type') == 'credito') {
                            return false;
                        }

                        return true;
                    })
                    ->afterStateUpdated(fn(Set $set, $state) => $state ? $set('title', $state . ' - ' . MonthHelper::getMonthCurrent()) : ''),
                Section::make('')
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        TextInput::make('title')
                            ->label('Tipo de gasto')
                            ->required()
                            ->columnSpan('full'),
                        Select::make('means_payment')
                            ->label('Meio de pagamento')
                            ->placeholder('Selecionar')
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->columnSpan(6)
                            ->options([
                                'Crédito'  => 'Crédito',
                                'Débito'   => 'Débito',
                                'Dinheiro' => 'Dinheiro'
                            ]),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->relationship('bank', 'title', function (Builder $query) {
                                $query->where('user_id', Auth::user()->id);
                            })
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->columnSpan(6),
                        DatePicker::make('pay_day')
                            ->label('Data de pagamento')
                            ->displayFormat('d/m/Y')
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->columnSpan(6),
                        DatePicker::make('due_date')
                            ->label('Data de vencimento')
                            ->displayFormat('d/m/Y')
                            ->columnSpan(6)
                            ->hidden(function (Get $get) {
                                if ($get('type') == 'fixo' || $get('type') == 'credito') {
                                    return false;
                                }

                                return true;
                            }),
                        Repeater::make('items_credit')
                            ->label('Itens do crédito')
                            ->columns(12)
                            ->columnSpan('full')
                            // ->afterStateUpdated(function (Expense $record, Set $set) {
                            //     if ($record) {
                            //         $creditValues = [];

                            //         foreach ($record->items_credit as $item) {
                            //             array_push($creditValues, $item['value']);
                            //         }

                            //         $creditTotalValues = array_sum($creditValues);

                            //         $set('value', $creditTotalValues);
                            //     }
                            // })
                            ->hidden(function (Get $get) {
                                if ($get('type') == 'credito') {
                                    return false;
                                }

                                return true;
                            })
                            ->schema([
                                TextInput::make('title')
                                    ->label('Título')
                                    ->columnSpan(6),
                                Select::make('category')
                                    ->label('Categoria')
                                    ->options(Category::where('user_id', Auth::user()->id)->orderBy('title', 'asc')->pluck('title', 'slug'))
                                    ->columnSpan(6),
                                Select::make('status')
                                    ->columnSpan(4)
                                    ->options([
                                        0 => 'Desnecessário',
                                        1 => 'Necessário'
                                    ]),
                                DatePicker::make('pay_day')
                                    ->label('Data')
                                    ->displayFormat('d/m/Y')
                                    ->format('d/m/Y')
                                    ->columnSpan(4),
                                TextInput::make('value')
                                    ->label('Valor')
                                    ->prefix('R$')
                                    ->columnSpan(4)
                            ])
                    ]),
                Section::make('')
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required()
                            ->columnSpan('full'),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->placeholder('Selecionar')
                            ->required()
                            ->reactive()
                            ->relationship('category', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)),
                        Select::make('status')
                            ->default(0)
                            ->options([
                                'pendente' => 'Pendente',
                                'pago'     => 'Pago',
                            ])
                            ->hidden(function (Get $get) {
                                if ($get('type') == 'fixo' || $get('type') == 'credito') {
                                    return false;
                                }

                                return true;
                            })
                    ]),
                Section::make('Uber')
                    ->columnSpan(9)
                    ->columns(12)
                    ->hidden(function (Get $get) {
                        $category = Category::find($get('category_id'));

                        if (isset($category)) {
                            if ($category->slug == 'uber') {
                                return false;
                            }
                        }

                        return true;
                    })
                    ->schema([
                        Select::make('uber_status')
                            ->label('Status')
                            ->columnSpan(4)
                            ->options([
                                0 => 'Não urgente',
                                1 => 'Pouco urgente',
                                2 => 'Urgente'
                            ]),
                        TextInput::make('uber_route_initial')
                            ->label('Corrida inicial')
                            ->columnSpan(4),
                        TextInput::make('uber_route_final')
                            ->label('Corrida final')
                            ->columnSpan(4)
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria'),
                Tables\Columns\ImageColumn::make('bank.icon_bank')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pago')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
                // ->formatStateUsing(fn (string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pendente' => 'danger',
                        'pago'     => 'success'
                    })
            ])->defaultSort('pay_day', 'desc')
            ->filters([
                Filter::make('month')
                    ->form([
                        Select::make('month')
                            ->label('Mês')
                            ->options([
                                '01' => 'Janeiro',
                                '02' => 'Fevereiro',
                                '03' => 'Março',
                                '04' => 'Abril',
                                '05' => 'Maio',
                                '06' => 'Junho',
                                '07' => 'Julho',
                                '08' => 'Agosto',
                                '09' => 'Setembro',
                                '10' => 'Outubro',
                                '11' => 'Novembro',
                                '12' => 'Dezembro',
                            ])
                            ->default(date('m')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['month'],
                                fn(Builder $query, $date): Builder => $query->whereMonth('pay_day', $date),
                            );
                    }),
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'inconstante' => 'Inconstante',
                        'fixo'       => 'Fixo',
                        'credito'    => 'Crédito'
                    ]),
                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)),
                SelectFilter::make('bank_id')
                    ->label('Banco')
                    ->relationship('bank', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)),
                SelectFilter::make('status')
                    ->options([
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago',
                    ]),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Data inicial'),
                        DatePicker::make('final_date')
                            ->label('Data final'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('pay_day', '>=', $date),
                            )
                            ->when(
                                $data['final_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('pay_day', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getExpensesFixedPedingQuery(): Builder
    {
        return Expense::whereYear('due_date', Carbon::now()->year)
            ->where('type', 'fixo')
            ->where('status', 'pendente')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc');
    }

    public static function getExpensesFixedPaidQuery(): Builder
    {
        return Expense::whereYear('due_date', Carbon::now()->year)
            ->whereMonth('due_date', Carbon::now()->month)
            ->whereIn('type', ['credito', 'fixo'])
            ->where('status', 'pago')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}

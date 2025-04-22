<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\{DatePicker, Repeater, Section, Select, TextInput, Wizard};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Enums\FiltersLayout;
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
                Section::make()
                    ->columnSpan(9)
                    ->columns(12)
                    ->schema([
                        Select::make('type')
                            ->label('Tipo')
                            ->default('inconstante')
                            ->required()
                            ->reactive()
                            ->columnSpan('full')
                            ->options([
                                'inconstante' => 'Inconstante',
                                'fixo'       => 'Fixo',
                            ]),
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->columnSpan('full'),
                        Select::make('mean_payment_id')
                            ->label('Meio de pagamento')
                            ->placeholder('Selecionar')
                            ->live()
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->columnSpan('full')
                            ->relationship('meanPayment', 'title'),
                        DatePicker::make('pay_in')
                            ->label('Pagar em')
                            ->displayFormat('d/m/Y')
                            ->columnSpan('full')
                            ->hidden(function (Get $get) {
                                if ($get('type') == 'fixo') {
                                    return false;
                                }

                                return true;
                            }),
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
                                if ($get('type') == 'fixo') {
                                    return false;
                                }

                                return true;
                            }),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required(),
                        Select::make('invoice_id')
                            ->label('Fatura')
                            ->relationship('invoice', 'title')
                            ->hidden(fn(Get $get): bool => $get('mean_payment_id') != '2' ? true : false),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->required(fn(Get $get) => $get('type') == 'inconstante' ?: false)
                            ->relationship('bank', 'title', function (Builder $query) {
                                $query->where('user_id', Auth::user()->id);
                            }),
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
                                if ($get('type') == 'fixo') {
                                    return false;
                                }

                                return true;
                            })
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
                Tables\Columns\TextColumn::make('meanPayment.title')
                    ->label('Meio de pagamnto'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pago')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => FormatCurrency::getFormatCurrency($state)),
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
                    ->columnSpan(6)
                    ->columns(2)
                    ->form([
                        Select::make('month')
                            ->label('Mês')
                            ->columnSpan(1)
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
                        Select::make('year')
                            ->label('Ano')
                            ->columnSpan(1)
                            ->options([
                                '2024' => '2024',
                                '2025' => '2025'
                            ])
                            ->default(date('Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['month'],
                                fn(Builder $query, $month): Builder => $query->whereMonth('pay_day', $month),
                            )
                            ->when(
                                $data['year'],
                                fn(Builder $query, $year): Builder => $query->whereYear('pay_day', $year),
                            );
                    }),
                Filter::make('pay_day')
                    ->columnSpan(6)
                    ->columns(2)
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Pagamento inicial')
                            ->columnSpan(1),
                        DatePicker::make('final_date')
                            ->label('Pagamento final')
                            ->columnSpan(1),
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
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->columnSpan(3)
                    ->options([
                        'inconstante' => 'Inconstante',
                        'fixo'       => 'Fixo'
                    ]),
                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id))
                    ->columnSpan(3),
                SelectFilter::make('bank_id')
                    ->label('Banco')
                    ->relationship('bank', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id))
                    ->columnSpan(3),
                SelectFilter::make('status')
                    ->columnSpan(3)
                    ->options([
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago',
                    ]),
                SelectFilter::make('invoice_id')
                    ->label('Fatura')
                    ->relationship('invoice', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id))
                    ->columnSpan(3),
            ], FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::ExtraLarge)
            ->filtersFormColumns(12)
            ->heading(function (Table $table) {
                $total = $table->getRecords()->sum('valor');

                return 'Total: ' . number_format($total, 2, ',', '.');
            })
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
            ->where('type', 'fixo')
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

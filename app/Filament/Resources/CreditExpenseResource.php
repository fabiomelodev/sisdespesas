<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditExpenseResource\Pages;
use App\Filament\Resources\CreditExpenseResource\RelationManagers;
use App\Helpers\FormatCurrency;
use App\Models\CreditExpense;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreditExpenseResource extends Resource
{
    protected static ?string $model = CreditExpense::class;

    protected static ?string $label = 'Despesa';

    protected static ?string $pluralLabel = 'Despesas';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('Créditos');
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
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan('full'),
                        DatePicker::make('pay_day')
                            ->label('Data de pagamento')
                            ->displayFormat('d/m/Y')
                            ->required()
                            ->columnSpan(6)
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
                            ->relationship('invoice', 'title'),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->required()
                            ->relationship('bank', 'title'),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->placeholder('Selecionar')
                            ->required()
                            ->reactive()
                            ->relationship('category', 'title'),
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
                Tables\Columns\TextColumn::make('invoice.title')
                    ->label('Fatura'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pago')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => FormatCurrency::getFormatCurrency($state)),
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
                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'title')
                    ->columnSpan(3),
                SelectFilter::make('bank_id')
                    ->label('Banco')
                    ->relationship('bank', 'title')
                    ->columnSpan(3),
                SelectFilter::make('invoice_id')
                    ->label('Fatura')
                    ->relationship('invoice', 'title')
                    ->columnSpan(3),
            ], FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::ExtraLarge)
            ->filtersFormColumns(12)
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCreditExpenses::route('/'),
            'create' => Pages\CreateCreditExpense::route('/create'),
            'edit' => Pages\EditCreditExpense::route('/{record}/edit'),
        ];
    }
}

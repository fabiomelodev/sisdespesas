<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditResource\Pages;
use App\Filament\Resources\CreditResource\RelationManagers;
use App\Models\Credit;
use Filament\Forms;
use Filament\Forms\Components\{DatePicker, Section, Select, TextInput, Wizard};
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CreditResource extends Resource
{
    protected static ?string $model = Credit::class;

    protected static ?string $label = 'Crédito';

    protected static ?string $pluralLabel = 'Créditos';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('Créditos');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 9,
                    ])
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                        DatePicker::make('pay_day')
                            ->label('Data do pagamento')
                            ->displayFormat('d/m/Y')
                            ->required()
                    ]),
                Section::make()
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 3,
                    ])
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required(),
                        Select::make('category_id')
                            ->label('Categoria')
                            ->placeholder('Selecionar')
                            ->relationship('category', 'title')
                            ->required(),
                        Select::make('invoice_id')
                            ->label('Fatura')
                            ->required()
                            ->relationship(
                                'invoice',
                                'title',
                                fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                            )
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->formatStateUsing(fn(string $state): string => mb_strimwidth($state, 0, 40, '...')),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria'),
                Tables\Columns\TextColumn::make('invoice.title')
                    ->label('Fatura'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pagamento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
            ])->defaultSort('pay_day', 'desc')
            ->filters([
                Filter::make('month')
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 6
                    ])
                    ->columns([
                        'default' => 2
                    ])
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
                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->placeholder('Selecionar')
                    ->relationship('category', 'title')
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 3
                    ]),
                SelectFilter::make('invoice_id')
                    ->label('Fatura')
                    ->columnSpan([
                        'default' => 'full',
                        'md'      => 3
                    ])
                    ->relationship(
                        'invoice',
                        'title',
                        fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                    )
            ], FiltersLayout::AboveContentCollapsible)
            ->filtersFormWidth(MaxWidth::ExtraLarge)
            ->filtersFormColumns(12)
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCredits::route('/'),
            'create' => Pages\CreateCredit::route('/create'),
            'edit' => Pages\EditCredit::route('/{record}/edit'),
        ];
    }
}

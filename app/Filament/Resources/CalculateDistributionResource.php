<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalculateDistributionResource\Pages;
use App\Filament\Resources\CalculateDistributionResource\RelationManagers;
use App\Helpers\CalculateValue;
use App\Helpers\FormatCurrency;
use App\Models\CalculateDistribution;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalculateDistributionResource extends Resource
{
    protected static ?string $model = CalculateDistribution::class;

    protected static ?string $label = 'Distribuição';

    protected static ?string $pluralLabel = 'Calcular distribuições';

    public static function getNavigationGroup(): ?string
    {
        return __('Ferramentas');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columns(12)
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->live()
                            ->columnSpan('full'),
                        Fieldset::make('Despesas')
                            ->columns(12)
                            ->columnSpan('full')
                            ->schema([
                                TextInput::make('expenses_percentage')
                                    ->label('Porcentagem')
                                    ->columnSpan(2)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        $result = CalculateValue::getCalculatePercetangeValue($get('value'), $state);

                                        $set('expenses_value', $result);
                                    }),
                                TextInput::make('expenses_value')
                                    ->label('Valor')
                                    ->prefix('R$')
                                    // ->disabled()
                                    ->columnSpan(10)
                            ]),
                        Fieldset::make('Lazer')
                            ->columns(12)
                            ->columnSpan('full')
                            ->schema([
                                TextInput::make('leisure_percentage')
                                    ->label('Porcentagem')
                                    ->columnSpan(2)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        $result = CalculateValue::getCalculatePercetangeValue($get('value'), $state);

                                        $set('leisure_value', $result);
                                    }),
                                TextInput::make('leisure_value')
                                    ->label('Valor')
                                    ->prefix('R$')
                                    // ->disabled()
                                    ->columnSpan(10)
                            ]),
                        Fieldset::make('Investimentos')
                            ->columns(12)
                            ->columnSpan('full')
                            ->schema([
                                TextInput::make('investments_percentage')
                                    ->label('Porcentagem')
                                    ->columnSpan(2)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        $result = CalculateValue::getCalculatePercetangeValue($get('value'), $state);

                                        $set('investments_value', $result);
                                    }),
                                TextInput::make('investments_value')
                                    ->label('Valor')
                                    ->prefix('R$')
                                    // ->disabled()
                                    ->columnSpan(10)
                            ]),
                        Fieldset::make('Dízimo')
                            ->columns(12)
                            ->columnSpan('full')
                            ->schema([
                                TextInput::make('we_tithe_percentage')
                                    ->label('Porcentagem')
                                    ->columnSpan(2)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                        $result = CalculateValue::getCalculatePercetangeValue($get('value'), $state);

                                        $set('we_tithe_value', $result);
                                    }),
                                TextInput::make('we_tithe_value')
                                    ->label('Valor')
                                    ->prefix('R$')
                                    // ->disabled()
                                    ->columnSpan(10)
                            ]),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        DatePicker::make('date')
                            ->label('Data')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(function ($state) {
                        return FormatCurrency::getFormatCurrency($state);
                    }),
                Tables\Columns\TextColumn::make('expenses_value')
                    ->label('Despesa')
                    ->badge()
                    ->formatStateUsing(function (CalculateDistribution $record) {
                        return $record->expenses_percentage . '% | ' . $record->expenses_value;
                    }),
                Tables\Columns\TextColumn::make('leisure_value')
                    ->label('Lazer')
                    ->badge()
                    ->formatStateUsing(function (CalculateDistribution $record) {
                        return $record->leisure_percentage . '% | ' . $record->leisure_value;
                    }),
                Tables\Columns\TextColumn::make('investments_value')
                    ->label('Investimento')
                    ->badge()
                    ->formatStateUsing(function (CalculateDistribution $record) {
                        return $record->investments_percentage . '% | ' . $record->investments_value;
                    }),
                Tables\Columns\TextColumn::make('we_tithe_value')
                    ->label('Dízimo')
                    ->badge()
                    ->formatStateUsing(function (CalculateDistribution $record) {
                        return $record->we_tithe_percentage . '% | ' . $record->we_tithe_value;
                    }),
                Tables\Columns\TextColumn::make('date')
                    ->label('Data')
                    ->dateTime('M/Y')
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListCalculateDistributions::route('/'),
            'create' => Pages\CreateCalculateDistribution::route('/create'),
            'edit' => Pages\EditCalculateDistribution::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestmentResource\Pages;
use App\Filament\Resources\InvestmentResource\RelationManagers;
use App\Helpers\FormatCurrency;
use App\Models\Investment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestmentResource extends Resource
{
    protected static ?string $model = Investment::class;

    protected static ?string $label = 'Investimento';

    protected static ?string $pluralLabel = 'Investimentos';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('Investimentos');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan(9)
                    ->schema([
                        Select::make('type_investment_id')
                            ->label('Tipo de investimento')
                            ->relationship('typeInvestment', 'title')
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$'),
                        DatePicker::make('created_at')
                            ->label('Criado')
                            ->hiddenOn('create')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('typeInvestment.title')
                    ->label('Tipo de investimento'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => FormatCurrency::getFormatCurrency($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y'),
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
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestment::route('/create'),
            'edit' => Pages\EditInvestment::route('/{record}/edit'),
        ];
    }
}

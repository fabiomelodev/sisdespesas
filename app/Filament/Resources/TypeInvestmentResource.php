<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeInvestmentResource\Pages;
use App\Filament\Resources\TypeInvestmentResource\RelationManagers;
use App\Models\TypeInvestment;
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

class TypeInvestmentResource extends Resource
{
    protected static ?string $model = TypeInvestment::class;

    protected static ?string $label = 'Tipo de investimento';

    protected static ?string $pluralLabel = 'Tipos de investimentos';

    protected static ?int $navigationSort = 2;

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
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('bank_id')
                            ->label('Banco')
                            ->relationship('bank', 'title')
                            ->required(),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->hiddenOn('create')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('bank.title')
                    ->label('Banco'),
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
            'index' => Pages\ListTypeInvestments::route('/'),
            'create' => Pages\CreateTypeInvestment::route('/create'),
            'edit' => Pages\EditTypeInvestment::route('/{record}/edit'),
        ];
    }
}

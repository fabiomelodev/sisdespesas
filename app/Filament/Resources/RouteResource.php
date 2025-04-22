<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RouteResource\Pages;
use App\Filament\Resources\RouteResource\RelationManagers;
use App\Models\Route;
use Filament\Forms;
use Filament\Forms\Components\{Section, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    protected static ?string $label = 'Rotas';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('Configurações');
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
                        TextInput::make('name')
                            ->label('Nome')
                            ->columnSpan(6),
                        TextInput::make('route')
                            ->label('Rota')
                            ->columnSpan(6)
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('status')
                            ->options([
                                0 => 'Inativo',
                                1 => 'Ativo'
                            ])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('route')
                    ->label('Rota'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        '0' => 'Inativo',
                        '1' => 'Ativo'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success'
                    })
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
            'index' => Pages\ListRoutes::route('/'),
            'create' => Pages\CreateRoute::route('/create'),
            'edit' => Pages\EditRoute::route('/{record}/edit'),
        ];
    }
}

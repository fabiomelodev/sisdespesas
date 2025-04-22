<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Forms\Components\{ColorPicker, DatePicker, FileUpload, Section, Textarea, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $label = 'Banco';

    protected static ?string $pluralLabel = 'Bancos';

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
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('title')
                            ->label('Banco')
                            ->columnSpan('full'),
                        Textarea::make('description')
                            ->label('Descrição')
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        ColorPicker::make('color')
                            ->label('Cor'),
                        FileUpload::make('icon_bank')
                            ->label('Ícone'),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->hiddenOn('create')
                            ->disabled()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição'),
                Tables\Columns\ImageColumn::make('icon_bank')
                    ->label('Ícone')
            ])
            ->defaultSort('title', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
        ];
    }
}

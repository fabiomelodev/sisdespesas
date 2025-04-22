<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardCreditResource\Pages;
use App\Filament\Resources\CardCreditResource\RelationManagers;
use App\Models\CardCredit;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CardCreditResource extends Resource
{
    protected static ?string $model = CardCredit::class;

    protected static ?string $label = 'Cartão de crédito';

    protected static ?string $pluralLabel = 'Cartões de crédito';

    protected static ?int $navigationSort = 1;

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
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required(),
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->required(),
                        Select::make('bank_id')
                            ->label('Banco')
                            ->required()
                            ->relationship('bank', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)),
                        Select::make('status')
                            ->required()
                            ->options([
                                '0' => 'Inativo',
                                '1' => 'Ativo'
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\ImageColumn::make('bank.icon_bank')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Limite')
                    ->formatStateUsing(fn($state): string => 'R$ ' . $state),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        '0' => 'Inativo',
                        '1' => 'Ativo'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success'
                    }),
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
            'index' => Pages\ListCardCredits::route('/'),
            'create' => Pages\CreateCardCredit::route('/create'),
            'edit' => Pages\EditCardCredit::route('/{record}/edit'),
        ];
    }
}

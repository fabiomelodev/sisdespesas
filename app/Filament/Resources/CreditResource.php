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
use Filament\Tables;
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
                    ->columnSpan(9)
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
                    ->columnSpan(3)
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
                    ->label('Título'),
                Tables\Columns\TextColumn::make('current_pensionem')
                    ->label('Parcela')
                    ->formatStateUsing(function (Credit $record) {
                        if ($record->number_installments) {
                            return $record->current_pensionem . '/' . $record->number_installments;
                        }

                        return $record->current_pensionem . '/' . $record->current_pensionem;
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('invoice.title')
                    ->label('Fatura'),
                // ->formatStateUsing(fn(Credit $record) => $record->invoice()->first()->title . ' - ' . $record->invoice()->first()->cardCredit()->first()->title),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pagamento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
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
            'index' => Pages\ListCredits::route('/'),
            'create' => Pages\CreateCredit::route('/create'),
            'edit' => Pages\EditCredit::route('/{record}/edit'),
        ];
    }
}

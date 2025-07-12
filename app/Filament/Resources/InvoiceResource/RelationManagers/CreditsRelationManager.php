<?php

namespace App\Filament\Resources\InvoiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CreditsRelationManager extends RelationManager
{
    protected static string $relationship = 'credits';

    protected static ?string $label = 'Crédito';

    protected static ?string $pluralLabel = 'Créditos';

    protected static ?string $title = 'Créditos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
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
                        // Select::make('invoice_id')
                        //     ->label('Fatura')
                        //     ->required()
                        //     ->relationship(
                        //         'invoice',
                        //         'title',
                        //         fn(Builder $query) => $query->where('user_id', Auth::user()->id)
                        //     )
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pagamento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
            ])->defaultSort('pay_day', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}

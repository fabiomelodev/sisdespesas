<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Helpers\FormatCurrency;
use App\Models\ImmediateExpense;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImmediateExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'immediateExpenses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->heading('Total ' . FormatCurrency::getFormatCurrency($this->getTableQuery()->sum('value')))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria'),
                Tables\Columns\ImageColumn::make('bank.icon_bank')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('meanPayment.title')
                    ->label('Meio de pagamnto'),
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data pago')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn(string $state): string => FormatCurrency::getFormatCurrency($state))
            ])
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

    protected function getTableQuery(): Builder
    {
        return ImmediateExpense::whereMonth('pay_day', Carbon::now()->month)
            ->whereYear('pay_day', Carbon::now()->year)
            ->whereRelation('category', 'id', $this->ownerRecord->id)
            ->orderBy('pay_day', 'desc');
    }
}

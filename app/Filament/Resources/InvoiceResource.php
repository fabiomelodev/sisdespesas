<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $label = 'Fatura';

    protected static ?string $pluralLabel = 'Faturas';

    protected static ?int $navigationSort = 2;

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
                            ->disabled()
                            ->hiddenOn('create'),
                        DatePicker::make('due_date')
                            ->label('Data de vencimento')
                            ->required()
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('card_credit_id')
                            ->label('Cartão')
                            ->required()
                            ->relationship('cardCredit', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id)->where('status', 1)),
                        TextInput::make('value')
                            ->label('Valor')
                            ->prefix('R$')
                            ->disabled(),
                        Select::make('status')
                            ->required()
                            ->options([
                                'pendente' => 'Pendente',
                                'pago'     => 'Pago'
                            ]),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->hiddenOn('create'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('cardCredit.title')
                    ->label('Cartão de crédito'),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de vencimento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn($state): string => 'R$ ' . $state),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pendente' => 'Pendente',
                        'pago'     => 'Pago'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pendente' => 'danger',
                        'pago'     => 'success'
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}

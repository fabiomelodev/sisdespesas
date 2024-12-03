<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstimatedResource\Pages;
use App\Filament\Resources\EstimatedResource\RelationManagers;
use App\Helpers\MonthHelper;
use App\Models\Category;
use App\Models\Estimated;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{DatePicker, Repeater, Section, Select, Tabs, TextInput};
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Model;

class EstimatedResource extends Resource
{
    protected static ?string $model = Estimated::class;

    protected static ?string $label = 'Estimativa';

    protected static ?string $pluralLabel = 'Estimativas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('month')
                            ->label('Mês')
                            ->options(MonthHelper::getMonths()),
                        Select::make('year')
                            ->label('Ano')
                            ->options([
                                '2024' => '2024',
                                '2025' => '2025'
                            ])
                    ]),
                Section::make()
                    ->hiddenOn('create')
                    ->columns(3)
                    ->schema([
                        TextInput::make('deposit_total')
                            ->label('Entrada total')
                            ->prefix('R$')
                            ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                        TextInput::make('expense_total')
                            ->label('Despesa total')
                            ->prefix('R$')
                            ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                        TextInput::make('remaining')
                            ->label('Restante')
                            ->prefix('R$')
                            ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                    ]),
                Tabs::make('Tabs')
                    ->columnSpan('full')
                    ->tabs([
                        Tabs\Tab::make('Entradas')
                            ->schema([
                                Repeater::make('deposits')
                                    ->label('Entradas')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('deposit')
                                            ->label('Entrada'),
                                        TextInput::make('value')
                                            ->label('Valor')
                                            ->prefix('R$'),
                                        DatePicker::make('pay_day')
                                            ->label('Data de pagamento')
                                    ])
                            ]),
                        Tabs\Tab::make('Despesas')
                            ->schema([
                                Repeater::make('expenses')
                                    ->label('Despesas')
                                    ->columns(4)
                                    ->schema([
                                        TextInput::make('expense')
                                            ->label('Despesa'),
                                        TextInput::make('value')
                                            ->label('Valor')
                                            ->prefix('R$'),
                                        DatePicker::make('pay_day')
                                            ->label('Data de vencimento'),
                                        Select::make('category')
                                            ->label('Categoria')
                                            ->options(fn() => Category::orderBy('title', 'asc')->get()->pluck('title', 'title'))
                                    ])
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_date')
                    ->label('Mês/Ano'),
                Tables\Columns\TextColumn::make('deposit_total')
                    ->label('Entrada')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('expense_total')
                    ->label('Despesa')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('remaining')
                    ->label('Restante')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.'))
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
            'index' => Pages\ListEstimateds::route('/'),
            'create' => Pages\CreateEstimated::route('/create'),
            'edit' => Pages\EditEstimated::route('/{record}/edit'),
        ];
    }
}

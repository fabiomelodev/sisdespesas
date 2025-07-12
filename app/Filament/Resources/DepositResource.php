<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Components\{DatePicker, Section, Select, Textarea, TextInput, Toggle};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $label = 'Entrada';

    protected static ?string $pluralLabel = 'Entradas';

    public static function getNavigationGroup(): ?string
    {
        return __('Despesas e Entradas');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('entry_date', '>=', now()->startOfMonth())
            ->where('entry_date', '<=', now()->endOfMonth())
            ->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('type')
                            ->label('Tipo')
                            ->required()
                            ->columnSpan('full'),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(5)
                            ->required()
                            ->columnSpan('full'),
                    ])
                    ->columnSpan(9),
                Section::make()
                    ->schema([
                        Select::make('bank_id')
                            ->label('Banco')
                            ->relationship('bank', 'title', function (Builder $query) {
                                $query->where('user_id', Auth::user()->id);
                            })
                            ->required(),
                        TextInput::make('wage')
                            ->label('Valor')
                            ->prefix('R$')
                            ->numeric()
                            ->required()
                            ->columnSpan('full'),
                        DatePicker::make('entry_date')
                            ->label('Data de entrada')
                            ->displayFormat('d/m/Y')
                            ->required()
                            ->columnSpan('full'),
                        Toggle::make('status')
                            ->label('Status')
                            ->required()
                            ->columnSpan('full'),
                    ])
                    ->columnSpan(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo'),
                Tables\Columns\ImageColumn::make('bank.icon_bank')
                    ->label('Banco'),
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Data de entrada')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('wage')
                    ->label('Salário')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        '0' => 'Pendente',
                        '1' => 'Concluído'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success'
                    }),
            ])->defaultSort('entry_date', 'desc')
            ->filters([
                Filter::make('month')
                    ->columnSpan(6)
                    ->form([
                        Select::make('month')
                            ->label('Mês')
                            ->options([
                                '01' => 'Janeiro',
                                '02' => 'Fevereiro',
                                '03' => 'Março',
                                '04' => 'Abril',
                                '05' => 'Maio',
                                '06' => 'Junho',
                                '07' => 'Julho',
                                '08' => 'Agosto',
                                '09' => 'Setembro',
                                '10' => 'Outubro',
                                '11' => 'Novembro',
                                '12' => 'Dezembro',
                            ])
                            ->default(date('m')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['month'],
                                fn(Builder $query, $date): Builder => $query->whereMonth('entry_date', $date),
                            );
                    }),
                Filter::make('year')
                    ->columnSpan(6)
                    ->form([
                        Select::make('year')
                            ->label('Ano')
                            ->options([
                                '2023' => '2023',
                                '2024' => '2024',
                                '2025' => '2025',
                                '2026' => '2026'
                            ])
                            ->default(date('Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['year'],
                                fn(Builder $query, $date): Builder => $query->whereYear('entry_date', $date),
                            );
                    }),
                SelectFilter::make('bank_id')
                    ->label('Banco')
                    ->columnSpan('full')
                    ->relationship('bank', 'title', fn(Builder $query) => $query->where('user_id', Auth::user()->id))
            ])
            ->filtersFormColumns(12)
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
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}

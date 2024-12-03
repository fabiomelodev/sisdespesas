<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\ExpenseResource;
use App\Helpers\FormatCurrency;
use Hydrat\TableLayoutToggle\Concerns\HasToggleableTable;
use Carbon\Carbon;

class ExpensesFixedPaidWidget extends BaseWidget
{
    use HasToggleableTable;

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        $livewire = $table->getLivewire();

        return $table
            ->query(ExpenseResource::getExpensesFixedPaidQuery())
            ->defaultSort('created_at', 'desc')
            ->heading(function (): string {
                return 'DESPESAS PAGAS - ' . FormatCurrency::getFormatCurrency(ExpenseResource::getExpensesFixedPaidQuery()->sum('value'));
            })
            ->columns(
                $livewire->isGridLayout()
                    ? static::getGridTableColumns()
                    : static::getListTableColumns()
            )
            ->contentGrid(
                fn() => $livewire->isListLayout()
                    ? null
                    : [
                        'md' => 2,
                        'lg' => 3,
                        'xl' => 2,
                    ]
            );
    }

    // Define the columns for the table when displayed in list layout
    public static function getListTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label('Título'),
            Tables\Columns\TextColumn::make('value')
                ->label('Valor')
                ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
            Tables\Columns\TextColumn::make('due_date')
                ->label('Vencimento')
                ->dateTime('d/m/y'),
        ];
    }

    public static function getGridTableColumns(): array
    {
        return [
            // Make sure to stack your columns together
            Tables\Columns\Layout\Stack::make([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('title')
                        ->label('Título')
                        ->weight('bold')
                ]),
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(fn(string $state): string => 'R$ ' . $state),
                Tables\Columns\TextColumn::make('due_date')
                    ->formatStateUsing(fn(string $state): string => 'Vencimento: ' . Carbon::parse($state)->format('d/m/Y'))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)

            ])->space(1)->extraAttributes([
                'class' => 'pb-2',
            ]),
        ];
    }
}

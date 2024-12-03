<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Expense;

class ControlOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $balance = Expense::getBalance();

        return [
            Stat::make('Entrada', $balance['deposit'])
                ->extraAttributes([
                    'class' => 'uppercase',
                    'wire:click' => '$emitUp("setStatusFilter", "processed")',
                ]),

            Stat::make('Despesas', $balance['expense'])
                ->color('danger')
                ->extraAttributes([
                    'class' => 'uppercase',
                    'wire:click' => '$emitUp("setStatusFilter", "processed")',
                ]),
            Stat::make('Restante', $balance['remaining_values'])
                ->extraAttributes([
                    'class' => 'uppercase',
                    'wire:click' => '$emitUp("setStatusFilter", "processed")',
                ]),
        ];
    }
}

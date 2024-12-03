<?php

namespace App\Filament\Widgets;

use App\Helpers\FormatCurrency;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use App\Models\Uber;

class UberTotalFilterWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $monthlyTotal = Uber::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month)->sum('value');

        $monthlyTotalPrev = Uber::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month - 1)->sum('value');

        $uberAnnual = Uber::whereYear('pay_day', Carbon::now()->year);

        $carMonthly = Uber::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month)->where('automobile', 'car');

        $motorcycleMonthly = Uber::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month)->where('automobile', 'motorcycle');

        return [
            Stat::make('Anual', FormatCurrency::getFormatCurrency($uberAnnual->sum('value')))
                ->description('Qtde: ' . $uberAnnual->count()),
            Stat::make('Mês atual', FormatCurrency::getFormatCurrency($monthlyTotal))
                ->description('Mês anterior: ' . FormatCurrency::getFormatCurrency($monthlyTotalPrev)),
            Stat::make('Carro mensal', FormatCurrency::getFormatCurrency($carMonthly->sum('value')))
                ->description('Qtde: ' . $carMonthly->count()),
            Stat::make('Moto mensal', FormatCurrency::getFormatCurrency($motorcycleMonthly->sum('value')))
                ->description('Qtde: ' . $motorcycleMonthly->count()),
        ];
    }
}

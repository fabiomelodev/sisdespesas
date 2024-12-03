<?php

namespace App\Filament\Widgets;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use App\Models\{Category, Meta, Uber};
use Illuminate\Support\Facades\Auth;

class UberMetaWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    // protected static string $view = 'filament.widgets.uber-meta-widget';

    protected function getColumns(): int
    {
        return 1;
    }

    protected function getStats(): array
    {
        $meta = Uber::getMetaMonthCurrent();

        $uberMonthCurrent = Uber::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month);

        $monthCurrent = MonthHelper::getMonthCurrent();

        return [
            Stat::make('Meta - ' . $monthCurrent, FormatCurrency::getFormatCurrency($uberMonthCurrent->sum('value')) . ' / ' . FormatCurrency::getFormatCurrency($meta->value))
        ];
    }
}

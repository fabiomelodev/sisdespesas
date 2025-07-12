<?php

namespace App\Filament\Resources\ImmediateExpenseResource\Widgets;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\ImmediateExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImmediateExpenseTotalMonthCurrentWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $monthCurrent = MonthHelper::getMonthCurrent();

        $expensesTotalMonth = FormatCurrency::getFormatCurrency(ImmediateExpense::whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month)->sum('value'));

        return [
            Stat::make($monthCurrent, $expensesTotalMonth)
        ];
    }
}

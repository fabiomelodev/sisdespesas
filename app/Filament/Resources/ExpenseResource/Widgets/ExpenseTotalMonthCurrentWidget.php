<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Expense;
use App\Models\Uber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseTotalMonthCurrentWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $monthCurrent = MonthHelper::getMonthCurrent();

        $expensesTotalMonth = FormatCurrency::getFormatCurrency(Expense::where('user_id', Auth::user()->id)->whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month)->sum('value'));

        return [
            Stat::make($monthCurrent, $expensesTotalMonth)
        ];
    }
}

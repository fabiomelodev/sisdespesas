<?php

namespace App\Filament\Resources\DepositResource\Widgets;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Deposit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DepositTotalMonthCurrentWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $monthCurrent = MonthHelper::getMonthCurrent();

        $depositsTotalMonth = FormatCurrency::getFormatCurrency(Deposit::where('user_id', Auth::user()->id)->whereYear('entry_date', Carbon::now()->year)->whereMonth('entry_date', Carbon::now()->month)->sum('wage'));

        return [
            Stat::make($monthCurrent, $depositsTotalMonth)
        ];
    }
}

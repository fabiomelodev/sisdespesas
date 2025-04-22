<?php

namespace App\Filament\Widgets;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Invoice;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InvoiceTotalCurrentWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $invoices = Invoice::whereMonth('due_date', Carbon::now()->addMonthsNoOverflow(1)->month)->whereYear('due_date', Carbon::now()->year)->sum('value');

        $month = MonthHelper::getMonth(Carbon::now()->addMonthsNoOverflow(1)->month);

        return [
            Stat::make('Total de ' . $month, FormatCurrency::getFormatCurrency($invoices))
        ];
    }
}

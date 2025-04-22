<?php

namespace App\Filament\Widgets;

use App\Models\Credit;
use Filament\Widgets\ChartWidget;
use App\Models\Expense;
use App\Models\MeanPayment;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class CreditChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Gastos mensal';

    public ?string $filter = 'year';

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 1;
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // $collectionTest = Expense::whereHas('category', fn(Builder $query) => $query->where('title', 'uber'))->when($activeFilter == 'today', fn(Builder $query) => $query->whereDate('pay_day', Carbon::now()->format('Y-m-d')))
        //     ->when($activeFilter == 'week', fn(Builder $query) => $query->whereBetween('pay_day', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]))
        //     ->when($activeFilter == 'month', fn(Builder $query) => $query->whereMonth('pay_day', Carbon::now()))
        //     ->when($activeFilter == 'year', fn(Builder $query) => $query->whereYear('pay_day', Carbon::now()));

        // $collection = MeanPayment::where('slug', 'credito')
        //     ->first()
        //     ->expenses()
        //     ->when($activeFilter == 'week', fn(Builder $query) => $query->whereBetween('pay_day', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]))
        //     ->when($activeFilter == 'month', fn(Builder $query) => $query->whereMonth('pay_day', Carbon::now()))
        //     ->when($activeFilter == 'year', fn(Builder $query) => $query->whereYear('pay_day', Carbon::now()))
        //     ->getQuery();

        $collection = Credit::when($activeFilter == 'week', fn(Builder $query) => $query->whereBetween('pay_day', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]))
            ->when($activeFilter == 'month', fn(Builder $query) => $query->whereMonth('pay_day', Carbon::now()))
            ->when($activeFilter == 'year', fn(Builder $query) => $query->whereYear('pay_day', Carbon::now()));

        $data = Trend::query($collection)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->dateColumn('pay_day')
            ->perMonth()
            ->sum('value');

        return [
            'datasets' => [
                [
                    'label' => 'R$',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

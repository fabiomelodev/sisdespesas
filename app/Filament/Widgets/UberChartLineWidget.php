<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Expense;
use App\Models\Uber;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UberChartLineWidget extends ChartWidget
{
    protected static ?string $heading = 'Gastos mensal a';

    public ?string $filter = 'year';

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 1;
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $collection = Uber::when($activeFilter == 'today', fn(Builder $query) => $query->whereDate('pay_day', Carbon::now()->format('Y-m-d')))
            ->when($activeFilter == 'week', fn(Builder $query) => $query->whereBetween('pay_day', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]))
            ->when($activeFilter == 'month', fn(Builder $query) => $query->whereMonth('pay_day', Carbon::now()))
            ->when($activeFilter == 'year', fn(Builder $query) => $query->whereYear('pay_day', Carbon::now()))
            ->when($activeFilter == 'last_year', fn(Builder $query) => $query->whereYear('pay_day', Carbon::now()->subYear()));

        $data = Trend::query($collection)
            ->between(
                start: $activeFilter != 'last_year' ? now()->startOfYear() : now()->subYear()->startOfYear(),
                end: $activeFilter != 'last_year' ? now()->endOfYear() : now()->subYear()->endOfYear(),
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

    protected function getFilters(): ?array
    {
        return [
            'today'     => 'Hoje',
            'year'      => 'Esse ano',
            'week'      => 'Última semana',
            'month'     => 'Úlitmo mês',
            'last_year' => 'Ano passado'
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Uber;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;


class UberChartPieWidget extends ChartWidget
{
    protected static ?string $heading = 'Gastos anual';

    public ?string $filter = 'year';

    protected static string $color = 'info';

    protected int | string | array $columnSpan = '1';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $collection = Uber::when($activeFilter == 'today', fn (Builder $query) => $query->whereDate('pay_day', Carbon::now()->format('Y-m-d')))
                        ->when($activeFilter == 'week', fn (Builder $query) => $query->whereBetween('pay_day', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]))
                        ->when($activeFilter == 'month', fn (Builder $query) => $query->whereMonth('pay_day', Carbon::now()))
                        ->when($activeFilter == 'year', fn (Builder $query) => $query->whereYear('pay_day', Carbon::now()));

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
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => $this->getBackgroundColorsByMonths(),
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hoje',
            'year'  => 'Esse ano',
            'week'  => 'Última semana',
            'month' => 'Úlitmo mês',
        ];
    }

    protected function getBackgroundColorsByMonths(): array
    {
        return [
            '01' => 'rgb(0, 50, 98)',
            '02' => 'rgb(0, 112, 187)',
            '03' => 'rgb(32, 114, 175)',
            '04' => 'rgb(49, 140, 231)',
            '05' => 'rgb(0, 149, 182)',
            '06' => 'rgb(59, 0, 219)',
            '07' => 'rgb(0, 191, 255)',
            '08' => 'rgb(75, 0, 130)',
            '09' => '#ADD8E6',
            '10' => '#73C2FB',
            '11' => '#9EB9D4',
            '12' => '#003153'
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}

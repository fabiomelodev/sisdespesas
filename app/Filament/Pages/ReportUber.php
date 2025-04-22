<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\UberChartLineWidget;
use App\Filament\Widgets\UberMetaWidget;
use App\Filament\Widgets\UberTotalFilterWidget;
use Filament\Pages\Page;

class ReportUber extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.report-uber';

    protected static ?string $navigationLabel = 'Uber';

    public static function getNavigationGroup(): ?string
    {
        return __('Relatórios');
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 2;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UberMetaWidget::make(),
            UberTotalFilterWidget::make(),
            UberChartLineWidget::class
        ];
    }
}

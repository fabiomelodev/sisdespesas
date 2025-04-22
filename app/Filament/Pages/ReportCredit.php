<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CreditChartWidget;
use Filament\Pages\Page;

class ReportCredit extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.report-credit';

    protected static ?string $navigationLabel = 'Créditos';

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
            CreditChartWidget::make(),
        ];
    }
}

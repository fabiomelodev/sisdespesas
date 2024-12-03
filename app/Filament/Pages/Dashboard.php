<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\WarningWidget;
use App\Filament\Widgets\ControlOverview;
use App\Filament\Widgets\ExpensesFixedPaidWidget;
use App\Filament\Widgets\ExpensesFixedPedingWidget;
use App\Filament\Widgets\CategoriesTotalWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function getHeading(): string
    {
        return '';
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 4;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            WarningWidget::make(),
            ControlOverview::make([
                'status' => 'active',
            ]),
            ExpensesFixedPedingWidget::make(),
            ExpensesFixedPaidWidget::make(),
            // CategoriesTotalWidget::make()
        ];
    }
}

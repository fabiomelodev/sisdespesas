<?php

namespace App\Filament\Resources\ImmediateExpenseResource\Pages;

use App\Filament\Resources\ImmediateExpenseResource;
use App\Filament\Resources\ImmediateExpenseResource\Widgets\ImmediateExpenseTotalMonthCurrentWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImmediateExpenses extends ListRecords
{
    protected static string $resource = ImmediateExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 2;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ImmediateExpenseTotalMonthCurrentWidget::make()
        ];
    }
}

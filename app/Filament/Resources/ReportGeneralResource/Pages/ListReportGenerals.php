<?php

namespace App\Filament\Resources\ReportGeneralResource\Pages;

use App\Filament\Resources\ReportGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportGenerals extends ListRecords
{
    protected static string $resource = ReportGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

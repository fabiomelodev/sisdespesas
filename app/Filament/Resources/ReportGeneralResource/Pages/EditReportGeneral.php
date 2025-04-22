<?php

namespace App\Filament\Resources\ReportGeneralResource\Pages;

use App\Filament\Resources\ReportGeneralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportGeneral extends EditRecord
{
    protected static string $resource = ReportGeneralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

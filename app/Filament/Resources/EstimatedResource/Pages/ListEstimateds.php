<?php

namespace App\Filament\Resources\EstimatedResource\Pages;

use App\Filament\Resources\EstimatedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstimateds extends ListRecords
{
    protected static string $resource = EstimatedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

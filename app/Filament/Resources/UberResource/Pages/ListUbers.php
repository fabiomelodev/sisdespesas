<?php

namespace App\Filament\Resources\UberResource\Pages;

use App\Filament\Resources\UberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUbers extends ListRecords
{
    protected static string $resource = UberResource::class;

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
        return [];
    }
}

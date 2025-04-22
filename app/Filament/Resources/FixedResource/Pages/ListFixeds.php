<?php

namespace App\Filament\Resources\FixedResource\Pages;

use App\Filament\Resources\FixedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFixeds extends ListRecords
{
    protected static string $resource = FixedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

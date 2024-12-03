<?php

namespace App\Filament\Resources\EstimatedResource\Pages;

use App\Filament\Resources\EstimatedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstimated extends EditRecord
{
    protected static string $resource = EstimatedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

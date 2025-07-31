<?php

namespace App\Filament\Resources\UberResource\Pages;

use App\Filament\Resources\UberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUber extends EditRecord
{
    protected static string $resource = UberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}

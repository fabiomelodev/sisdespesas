<?php

namespace App\Filament\Resources\FixedResource\Pages;

use App\Filament\Resources\FixedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFixed extends EditRecord
{
    protected static string $resource = FixedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

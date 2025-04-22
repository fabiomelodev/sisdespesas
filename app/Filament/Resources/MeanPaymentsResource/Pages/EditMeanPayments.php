<?php

namespace App\Filament\Resources\MeanPaymentsResource\Pages;

use App\Filament\Resources\MeanPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeanPayments extends EditRecord
{
    protected static string $resource = MeanPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

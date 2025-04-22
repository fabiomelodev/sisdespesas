<?php

namespace App\Filament\Resources\CardCreditResource\Pages;

use App\Filament\Resources\CardCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCardCredit extends EditRecord
{
    protected static string $resource = CardCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

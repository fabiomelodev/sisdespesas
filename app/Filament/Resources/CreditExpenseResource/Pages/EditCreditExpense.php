<?php

namespace App\Filament\Resources\CreditExpenseResource\Pages;

use App\Filament\Resources\CreditExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreditExpense extends EditRecord
{
    protected static string $resource = CreditExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

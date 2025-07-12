<?php

namespace App\Filament\Resources\ImmediateExpenseResource\Pages;

use App\Filament\Resources\ImmediateExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImmediateExpense extends EditRecord
{
    protected static string $resource = ImmediateExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

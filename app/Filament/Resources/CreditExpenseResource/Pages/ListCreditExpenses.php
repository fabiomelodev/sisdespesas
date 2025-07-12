<?php

namespace App\Filament\Resources\CreditExpenseResource\Pages;

use App\Filament\Resources\CreditExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCreditExpenses extends ListRecords
{
    protected static string $resource = CreditExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

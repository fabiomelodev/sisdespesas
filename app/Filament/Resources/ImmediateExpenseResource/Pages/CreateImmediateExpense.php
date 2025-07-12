<?php

namespace App\Filament\Resources\ImmediateExpenseResource\Pages;

use App\Filament\Resources\ImmediateExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateImmediateExpense extends CreateRecord
{
    protected static string $resource = ImmediateExpenseResource::class;
}

<?php

namespace App\Filament\Resources\CardCreditResource\Pages;

use App\Filament\Resources\CardCreditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCardCredits extends ListRecords
{
    protected static string $resource = CardCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

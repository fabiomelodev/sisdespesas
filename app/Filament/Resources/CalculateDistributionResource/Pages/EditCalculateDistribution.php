<?php

namespace App\Filament\Resources\CalculateDistributionResource\Pages;

use App\Filament\Resources\CalculateDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalculateDistribution extends EditRecord
{
    protected static string $resource = CalculateDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\TypeInvestmentResource\Pages;

use App\Filament\Resources\TypeInvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeInvestments extends ListRecords
{
    protected static string $resource = TypeInvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

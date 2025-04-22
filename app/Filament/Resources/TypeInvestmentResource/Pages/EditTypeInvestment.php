<?php

namespace App\Filament\Resources\TypeInvestmentResource\Pages;

use App\Filament\Resources\TypeInvestmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeInvestment extends EditRecord
{
    protected static string $resource = TypeInvestmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\MetaResource\Pages;

use App\Filament\Resources\MetaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListMetas extends ListRecords
{
    protected static string $resource = MetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return $this->getModel()::where('user_id', Auth::user()->id);
    }
}

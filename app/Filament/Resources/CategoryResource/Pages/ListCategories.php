<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Widgets\CategoryValuesTableWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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

    // public function getHeaderWidgetsColumns(): int | array
    // {
    //     return 2;
    // }

    protected function getHeaderWidgets(): array
    {
        return [
            CategoryValuesTableWidget::class
        ];
    }
}

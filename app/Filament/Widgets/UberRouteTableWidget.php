<?php

namespace App\Filament\Widgets;

use App\Models\Route;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UberRouteTableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Route::orderBy('created', 'desc')
            )
            ->columns([
                // ...
            ]);
    }
}

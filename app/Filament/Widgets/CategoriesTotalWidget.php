<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\CategoryResource;

class CategoriesTotalWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(CategoryResource::getCategoriesTotal())
            ->columns([
                Tables\Columns\TextColumn::make('total')
                    ->label('Categoria')
            ]);
    }
}

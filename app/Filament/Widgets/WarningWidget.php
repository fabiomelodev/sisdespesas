<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Warning;

class WarningWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => Warning::query()->where('status', '1')->orderBy('created_at', 'desc')->first())
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Aviso'),
            ]);
    }
}

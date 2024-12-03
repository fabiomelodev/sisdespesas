<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Uber;

class UberTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Uber';

    public function table(Table $table): Table
    {
        return $table
            ->query(Uber::orderBy('pay_day', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('pay_day')
                    ->label('Data de pagamento')
                    ->dateTime('d/m/y'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn (string $state): string => 'R$ ' . $state),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ]);
    }
}

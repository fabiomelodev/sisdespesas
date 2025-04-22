<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeanPaymentsResource\Pages;
use App\Filament\Resources\MeanPaymentsResource\RelationManagers;
use App\Models\MeanPayment;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeanPaymentsResource extends Resource
{
    protected static ?string $model = MeanPayment::class;

    protected static ?string $label = 'Meio de pagamento';

    protected static ?string $pluralLabel = 'Meios de pagamentos';

    public static function getNavigationGroup(): ?string
    {
        return __('Configurações');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Título')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
            ])->defaultSort('title', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeanPayments::route('/'),
            'create' => Pages\CreateMeanPayments::route('/create'),
            'edit' => Pages\EditMeanPayments::route('/{record}/edit'),
        ];
    }
}

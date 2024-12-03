<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarningResource\Pages;
use App\Filament\Resources\WarningResource\RelationManagers;
use App\Models\Warning;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WarningResource extends Resource
{
    protected static ?string $model = Warning::class;

    protected static ?string $label = 'Aviso';

    protected static ?string $pluralLabel = 'Avisos';

    protected static ?string $navigationGroup = 'Avisos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make('Aviso')
                    ->columnSpan(9)
                    ->schema([
                        MarkdownEditor::make('text')
                            ->label('Aviso')
                            ->columnSpan('full')
                    ]),
                Section::make('Status')
                    ->columnSpan(3)
                    ->schema([
                        Select::make('status')
                            ->options([
                                0 => 'Inativo',
                                1 => 'Ativo'
                            ])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Aviso'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Inativo',
                        '1' => 'Ativo'
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registrado em')
                    ->dateTime('d/m/Y')
            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListWarnings::route('/'),
            'create' => Pages\CreateWarning::route('/create'),
            'edit' => Pages\EditWarning::route('/{record}/edit'),
        ];
    }
}

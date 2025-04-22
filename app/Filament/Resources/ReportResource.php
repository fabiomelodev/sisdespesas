<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $label = 'Relatório';

    protected static ?string $pluralLabel = 'Relatórios';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('Geral');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                Section::make()
                    ->columnSpan(9)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título'),
                        MarkdownEditor::make('content')
                            ->label('Conteúdo')
                    ]),
                Section::make()
                    ->columnSpan(3)
                    ->schema([
                        Select::make('status')
                            ->default(0)
                            ->options([
                                'inativo' => 'Inativo',
                                'ativo'   => 'Ativo',
                            ]),
                        DatePicker::make('date')
                            ->label('Data'),
                        DatePicker::make('created_at')
                            ->label('Criado em')
                            ->disabled()
                            ->hiddenOn('create'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título'),
                Tables\Columns\TextColumn::make('date')
                    ->label('Data')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'inativo' => 'Inativo',
                        'ativo'   => 'Ativo'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'inativo' => 'danger',
                        'ativo'   => 'success'
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}

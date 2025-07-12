<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $label = 'Categoria';

    protected static ?string $pluralLabel = 'Categorias';

    public static function getNavigationGroup(): ?string
    {
        return __('Configurações');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Categoria')
                    ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Categoria')
            ])->defaultSort('title', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getCategoriesTotal(): Builder
    {
        return Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.title, SUM(expenses.value) as total')
            ->selectRaw('categories.id as category_id')
            ->where('expenses.user_id', Auth::user()->id)
            ->orderBy('title', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ImmediateExpensesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}

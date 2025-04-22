<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Expense;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryValuesTableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                static::getCategoriesValueQuery()
            )
            ->columns([
                // ...
            ]);
    }

    public static function getCategoriesValueQuery()
    {
        return Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.title, SUM(expenses.value) as total')
            ->selectRaw('categories.id as category_id')
            ->where('expenses.user_id', Auth::user()->id);
    }
}

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UberController;
use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PanelController::class, 'auth'])->name('auth');

Route::get('/dashboard', [PanelController::class, 'index'])->name('dashboard.index');

Route::get('/metas', function () {
    $expensesMetas = Category::join('expenses', 'categories.id', '=', 'expenses.category_id')
        ->selectRaw('categories.title, SUM(expenses.value) as total')
        ->groupBy('categories.id')
        ->join('metas', 'categories.id', 'metas.category_id')
        ->selectRaw('metas.value as meta_value')
        ->groupBy('metas.id')
        ->whereMonth('expenses.pay_day', Carbon::now()->month)
        ->where('metas.year', Carbon::now()->year)
        ->where('metas.month', Carbon::now()->month)
        ->where('expenses.user_id', Auth::user()->id)
        ->where('metas.user_id', Auth::user()->id)
        ->get();

    return view('pages.goals-categories', [
        'expensesMetas' => $expensesMetas
    ]);
})->name('goals.index');

Route::get('/despesa/{expense:id}', [PanelController::class, 'showExpenseFixed'])->name('expense.showExpenseFixed');

// Route::get('/metas', fn () => view('pages.metas'))->name('metas');

Route::put('/despesa/{id}/atualizar', [PanelController::class, 'updateExpenseFixed'])->name('expense.updateExpenseFixed');

Route::get('/categoria/{category:id}/', [CategoryController::class, 'show'])->name('category.show');

Route::get('/uber', [UberController::class, 'index'])->name('uber.index');

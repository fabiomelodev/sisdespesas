<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Livewire\Expenses\ExpenseEdit;
use App\Models\Category;
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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dashboard/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('dashboard/categorias/criar', [CategoryController::class, 'create'])->name('categories.create');
Route::post('dashboard/categories/criar', [CategoryController::class, 'store'])->name('categories.store');
Route::get('dashboard/categorias/{category:id}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('dashboard/categorias/{id}/atualizar', [CategoryController::class, 'update'])->name('categories.update');
Route::get('dashboard/categorias/{id}/excluir', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('dashboard/despesas/criar', fn() => view('pages.expenses.create'))->name('expenses.create');
Route::get('dashboard/despesas', fn() => view('pages.expenses.index'))->name('expenses.index');
Route::get('dashboard/despesas/{expense:id}/editar', [ExpenseController::class, 'edit'])->name('expenses.edit');
// Route::get('dashboard/despesas/{id}/editar', ExpenseEdit::class)->name('expense.edit');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ReportGeneralController;
use App\Http\Controllers\UberController;
use App\Models\Category;
use App\Models\CreditExpense;
use App\Models\Expense;
use App\Models\ImmediateExpense;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

Route::get('/despesa/{expense:id}', [PanelController::class, 'showExpenseFixed'])->name('expense.showExpenseFixed');

Route::put('/despesa/{id}/atualizar', [PanelController::class, 'updateExpenseFixed'])->name('expense.updateExpenseFixed');

Route::get('/categoria/{category:id}/', [CategoryController::class, 'show'])->name('category.show');

Route::get('relatorio-geral/{reportGeneral:code}', [ReportGeneralController::class, 'show'])->name('report-general.show');

// Route::get('entradas', function () {
//     App\Models\Deposit::all()->each(function ($deposit) {
//         $deposit->status = match ($deposit->status) {
//             '0' => 'pendente',
//             '1' => 'pago',
//         };
//         $deposit->save();
//     });
// });

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

Route::get('despesas-creditos', function () {
    // die;
    // $expenses = Expense::whereHas('meanPayment', function (Builder $query) {
    //     $query->where('user_id', Auth::user()->id)
    //         ->where('pay_day', '>=', '2025-01-01')
    //         ->where('pay_day', '<=', Carbon::now()->endOfDay())
    //         ->where('mean_payment_id', 2);
    // })->get();

    // foreach ($expenses as $expense) {
    //     CreditExpense::create([
    //         'title'           => $expense->title,
    //         'value'           => $expense->value,
    //         'pay_day'         => $expense->pay_day,
    //         'bank_id'         => $expense->bank_id,
    //         'category_id'     => $expense->category_id,
    //         'invoice_id'      => $expense->invoice_id,
    //     ]);
    // }
});

<?php

namespace App\Http\Controllers;

use App\Models\{Bank, Category, Expense, Warning};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        $balance = Expense::getBalance();

        $expensesFixed = Expense::getFixedExpensesPaid();

        $totalFixedExpensesPaid = Expense::getTotalFixedExpensesPaid();

        $totalFixedExpensesPeding = Expense::getTotalFixedExpensesPeding();

        $fixedExpensesTotalArrears = Expense::getFixedExpensesTotalArrears();

        $creditPrimaryCurrent = Expense::where('type', 'credito')
            ->whereYear('due_date', Carbon::now()->year)
            ->where('status', 'pendente')
            ->where('title', 'LIKE', '%3026%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc')
            ->first();

        $creditSecondaryCurrent = Expense::where('type', 'credito')
            ->whereYear('due_date', Carbon::now()->year)
            ->where('status', 'pendente')
            ->where('title', 'LIKE', '%6993%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc')
            ->first();

        $creditPrimarySumValues = 0;

        $creditSecondarySumValues = 0;

        if (isset($creditPrimaryCurrent) && isset($creditSecondaryCurrent)) {
            $creditPrimaryValues = [];
            $creditSecondaryValues = [];

            foreach ($creditPrimaryCurrent->items_credit as $item) {
                array_push($creditPrimaryValues, (float) $item['value']);
            }

            foreach ($creditSecondaryCurrent->items_credit as $item) {
                array_push($creditSecondaryValues, (float) $item['value']);
            }

            $creditPrimarySumValues = array_sum($creditPrimaryValues);

            $creditSecondarySumValues = array_sum($creditSecondaryValues);
        }

        $warnings = Warning::orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        $categoriesMetas = Category::getCategoriesMetas();

        return view('pages.dashboard', [
            'balance'                   => $balance,
            'totalFixedExpensesPaid'    => $totalFixedExpensesPaid,
            'expensesFixed'             => $expensesFixed,
            'totalFixedExpensesPeding'  => $totalFixedExpensesPeding,
            'fixedExpensesTotalArrears' => $fixedExpensesTotalArrears,
            'creditPrimaryCurrent'      => $creditPrimaryCurrent,
            'creditSecondaryCurrent'    => $creditSecondaryCurrent,
            'creditPrimarySumValues'    => $creditPrimarySumValues,
            'creditSecondarySumValues'  => $creditSecondarySumValues,
            'warnings'                  => $warnings,
            'categoriesMetas'           => $categoriesMetas
        ]);
    }

    public function showExpenseFixed(Expense $expense)
    {
        $banks = Bank::where('user_id', Auth::user()->id)->get();

        return view('pages.single-expense-fixed', [
            'expense' => $expense,
            'banks'   => $banks
        ]);
    }

    public function updateExpenseFixed(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        $expense->bank_id = $request->input('bank_id');

        $expense->pay_day = $request->input('pay_day');

        $expense->status = $request->input('status');

        $expense->update();

        return redirect(route('dashboard'));
    }

    public function auth()
    {
        if (!Auth::check()) {
            return redirect('admin/login');
        }

        return redirect(route('dashboard.index'));
    }
}

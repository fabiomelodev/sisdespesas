<?php

namespace App\Http\Controllers;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Bank;
use App\Models\CardCredit;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ImmediateExpense;
use App\Models\Invoice;
use App\Models\Meta;
use App\Models\ReportGeneral;
use App\Models\Uber;
use App\Models\Warning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReportGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportGeneral $reportGeneral)
    {
        $dateCurrent = MonthHelper::getMonth($reportGeneral->month) . ' / ' . $reportGeneral->year;

        $expensesFixedPeding = ImmediateExpense::getExpensesFixedPedingCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $expensesFixedPedingTotalValues = $expensesFixedPeding->sum(fn($expense) => is_numeric($expense->value) ? (float) $expense->value : 0);

        $expensesFixedPaid = ImmediateExpense::getExpensesFixedPaidCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $expensesFixedPaidTotalValues = $expensesFixedPaid->sum(fn($expense) => (float) $expense->value);

        $expensesCategories = Category::getTotalCategoriesImmediateExpensesCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $cardCredits = CardCredit::getCardCreditsTotalCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $invoicesNextMonth = Invoice::whereMonth('due_date', $reportGeneral->month + 1)
            ->whereYear('due_date', $reportGeneral->year)
            ->get();

        $warnings = Warning::whereMonth('date_current', $reportGeneral->month)
            ->whereYear('date_current', $reportGeneral->year)
            ->get();

        return view('pages.single-report-general', [
            'reportGeneral'                  => $reportGeneral,
            'dateCurrent'                    => $dateCurrent,
            'expensesFixedPeding'            => $expensesFixedPeding,
            'expensesFixedPedingTotalValues' => $expensesFixedPedingTotalValues,
            'expensesFixedPaid'              => $expensesFixedPaid,
            'expensesFixedPaidTotalValues'   => $expensesFixedPaidTotalValues,
            'expensesCategories'             => $expensesCategories,
            'cardCredits'                    => $cardCredits,
            'invoicesNextMonth'              => $invoicesNextMonth,
            'warnings'                       => $warnings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

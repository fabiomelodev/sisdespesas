<?php

namespace App\Http\Controllers;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Bank;
use App\Models\CardCredit;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ImmediateExpense;
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

        $banks = Bank::getTotalBankValueCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $expensesFixedPeding = ImmediateExpense::getExpensesFixedPedingCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $expensesFixedPedingTotalValues = $expensesFixedPeding->sum(fn($expense) => is_numeric($expense->value) ? (float) $expense->value : 0);

        $expensesFixedPaid = ImmediateExpense::getExpensesFixedPaidCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $expensesFixedPaidTotalValues = $expensesFixedPaid->sum(fn($expense) => (float) $expense->value);

        $expensesCategories = Category::getTotalCategoriesImmediateExpensesCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $cardCredits = CardCredit::getCardCreditsTotalCurrentMonth($reportGeneral->month, $reportGeneral->year);;

        $metas = Meta::getMetasByCategoryCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $ubersYearCurrent = Uber::whereYear('pay_day', $reportGeneral->year)->get();

        $ubersYearCurrentTotalValue = $ubersYearCurrent->sum(fn($uber) => is_numeric((float) $uber->value) ? (float) $uber->value : 0);

        $ubersYearCurrentQty = $ubersYearCurrent->count();

        $ubersMonthCurrent = Uber::whereMonth('pay_day', $reportGeneral->month)
            ->whereYear('pay_day', $reportGeneral->year)->get();

        $ubersMonthCurrentTotalValue = $ubersMonthCurrent->sum(fn($uber) => is_numeric((float) $uber->value) ? (float) $uber->value : 0);

        $ubersMonthCurrentQty = $ubersMonthCurrent->count();

        $ubersCar = Uber::whereMonth('pay_day', $reportGeneral->month)
            ->whereYear('pay_day', $reportGeneral->year)
            ->where('automobile', 'car')
            ->get();

        $ubersCarTotalValues = $ubersCar->sum(fn($uber) => is_numeric((float) $uber->value) ? (float) $uber->value : 0);

        $ubersCarQty = $ubersCar->count();

        $ubersMotorcycle = Uber::whereMonth('pay_day', $reportGeneral->month)
            ->whereYear('pay_day', $reportGeneral->year)
            ->where('automobile', 'motorcycle')
            ->get();

        $ubersMotorcycleTotalValues = $ubersMotorcycle->sum(fn($uber) => is_numeric((float) $uber->value) ? (float) $uber->value : 0);

        $ubersMotorcycleQty = $ubersMotorcycle->count();

        $uberMeta = Uber::getMetaByDate($reportGeneral->month, $reportGeneral->year);

        $uberMetaPercentage = FormatCurrency::getFormatValuePercentage($ubersMonthCurrentTotalValue, $uberMeta->value);

        $warnings = Warning::whereMonth('date_current', $reportGeneral->month)
            ->whereYear('date_current', $reportGeneral->year)
            ->get();

        return view('pages.single-report-general', [
            'reportGeneral'                  => $reportGeneral,
            'dateCurrent'                    => $dateCurrent,
            'banks'                          => $banks,
            'expensesFixedPeding'            => $expensesFixedPeding,
            'expensesFixedPedingTotalValues' => $expensesFixedPedingTotalValues,
            'expensesFixedPaid'              => $expensesFixedPaid,
            'expensesFixedPaidTotalValues'   => $expensesFixedPaidTotalValues,
            'expensesCategories'             => $expensesCategories,
            'cardCredits'                    => $cardCredits,
            'metas'                          => $metas,
            'ubersYearCurrentTotalValue'     => $ubersYearCurrentTotalValue,
            'ubersYearCurrentQty'            => $ubersYearCurrentQty,
            'ubersMonthCurrentTotalValue'    => $ubersMonthCurrentTotalValue,
            'ubersMonthCurrentQty'           => $ubersMonthCurrentQty,
            'ubersCarTotalValues'            => $ubersCarTotalValues,
            'ubersCarQty'                    => $ubersCarQty,
            'ubersMotorcycleTotalValues'     => $ubersMotorcycleTotalValues,
            'ubersMotorcycleQty'             => $ubersMotorcycleQty,
            'uberMeta'                       => $uberMeta,
            'uberMetaPercentage'             => $uberMetaPercentage,
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

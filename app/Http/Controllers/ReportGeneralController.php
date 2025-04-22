<?php

namespace App\Http\Controllers;

use App\Helpers\FormatCurrency;
use App\Helpers\MonthHelper;
use App\Models\Bank;
use App\Models\Expense;
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

        $banks = Bank::get()
            ->map(function ($bank) use ($reportGeneral) {
                $expensesTotalValue = $bank->expenses()
                    ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
                    ->where('status', 'pago')
                    ->whereMonth('pay_day', $reportGeneral->month)
                    ->whereYear('pay_day', $reportGeneral->year)
                    ->sum('value');

                $ubersTotalValue = $bank->ubers()
                    ->whereMonth('pay_day', $reportGeneral->month)
                    ->whereYear('pay_day', $reportGeneral->year)
                    ->sum('value');

                $expenses = $expensesTotalValue + $ubersTotalValue;

                $depositsTotalValue = $bank->deposits()
                    ->where('status', 1)
                    ->whereMonth('entry_date', $reportGeneral->month)
                    ->whereYear('entry_date', $reportGeneral->year)
                    ->sum('wage');

                $remainingTotalValue = $depositsTotalValue - $expenses;

                return [
                    'title'     => $bank->title,
                    'icon'      => $bank->icon_bank,
                    'color'     => $bank->color,
                    'deposits'  => FormatCurrency::getFormatCurrency($depositsTotalValue),
                    'expenses'  => FormatCurrency::getFormatCurrency($expenses),
                    'remaining' => FormatCurrency::getFormatCurrency($remainingTotalValue)
                ];
            });

        $expensesFixedPeding = Expense::whereMonth('pay_in', $reportGeneral->month)
            ->whereYear('pay_in', $reportGeneral->year)
            ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
            ->where('type', 'fixo')
            ->where('status', 'pendente')
            ->get();

        $expensesFixedPedingTotalValues = $expensesFixedPeding->sum(fn($expense) => is_numeric($expense->value) ? (float) $expense->value : 0);

        $expensesFixedPaid = Expense::whereMonth('pay_in', $reportGeneral->month)
            ->whereYear('pay_in', $reportGeneral->year)
            ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
            ->where('type', 'fixo')
            ->where('status', 'pago')
            ->get();

        $expensesFixedPaidTotalValues = $expensesFixedPaid->sum(fn($expense) => (float) $expense->value);

        $expensesCategories = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.title, SUM(expenses.value) as total')
            ->selectRaw('categories.id as category_id')
            ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
            ->when($reportGeneral->month != null, function (Builder $query) use ($reportGeneral) {
                return $query->whereMonth('expenses.pay_day', $reportGeneral->month);
            })->groupBy('categories.id')
            ->when($reportGeneral->month != null, function (Builder $query) use ($reportGeneral) {
                return $query->whereYear('expenses.pay_day', $reportGeneral->year);
            })->groupBy('categories.id')
            ->where('expenses.user_id', Auth::user()->id)
            ->orderBy('title', 'asc')
            ->get();

        $metas = Meta::where('month', $reportGeneral->month)
            ->where('year', $reportGeneral->year)
            ->get()
            ->map(function ($meta) use ($reportGeneral) {
                if ($meta->category()->first()->slug == 'uber') {
                    $expensesValue = $meta->category()
                        ->first()
                        ->ubers()
                        ->whereMonth('pay_day', $reportGeneral->month)
                        ->whereYear('pay_day', $reportGeneral->year)->sum('value');
                } else {
                    $expensesValue = $meta->category()
                        ->first()
                        ->expenses()
                        ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
                        ->whereMonth('pay_day', $reportGeneral->month)
                        ->whereYear('pay_day', $reportGeneral->year)
                        ->sum('value');
                }

                $category = $meta->category()->first();

                $percentage = FormatCurrency::getFormatValuePercentage($expensesValue, $meta->value);

                return [
                    'title'      => $category->title,
                    'value'      => FormatCurrency::getFormatCurrency($expensesValue),
                    'meta'       => FormatCurrency::getFormatCurrency($meta->value),
                    'percentage' => $percentage
                ];
            });

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
            'dateCurrent'                    => $dateCurrent,
            'banks'                          => $banks,
            'expensesFixedPeding'            => $expensesFixedPeding,
            'expensesFixedPedingTotalValues' => $expensesFixedPedingTotalValues,
            'expensesFixedPaid'              => $expensesFixedPaid,
            'expensesFixedPaidTotalValues'   => $expensesFixedPaidTotalValues,
            'expensesCategories'             => $expensesCategories,
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

<?php

namespace App\Models;

use App\Helpers\FormatCurrency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'pay_day'      => 'datetime',
        'due_date'     => 'datetime',
        'created_at'   => 'datetime',
        'pay_in'       => 'datetime'
    ];

    protected static function booted(): void
    {
        static::creating(function ($expense) {
            $expense->user_id = 1;

            if ($expense->type == 'inconstante') {
                $expense->status = 'pago';
            }
        });

        static::updating(function ($expense) {
            $expense->user_id = 1;

            if ($expense->type == 'inconstante') {
                $expense->status = 'pago';
            }
        });
    }

    public static function getBalance(): array
    {
        $expenses = Expense::whereYear('pay_day', Carbon::now()->year)
            ->whereMonth('pay_day', Carbon::now()->month)
            ->where('status', 'pago')
            ->where('user_id', Auth::user()->id)
            ->get();

        if (!$expenses->isEmpty()) {

            $expensesValues = [];

            foreach ($expenses as $expense) {
                array_push($expensesValues, $expense->value);
            }

            $expensesSumValues = array_sum($expensesValues);

            $deposits = Deposit::whereYear('entry_date', Carbon::now()->year)
                ->whereMonth('entry_date', Carbon::now()->month)
                ->where('status', 1)
                ->where('user_id', Auth::user()->id)
                ->get();

            $depositsValues = [];

            foreach ($deposits as $deposit) {
                array_push($depositsValues, $deposit->wage);
            }

            $depositsSumValues = array_sum($depositsValues);

            $remainingValues = $depositsSumValues > $expensesSumValues ? $depositsSumValues - $expensesSumValues : $expensesSumValues - $depositsSumValues;

            return [
                'deposit'          => FormatCurrency::getFormatCurrency($depositsSumValues),
                'expense'          => FormatCurrency::getFormatCurrency($expensesSumValues),
                'remaining_values' => FormatCurrency::getFormatCurrency($remainingValues)
            ];
        }

        return [];
    }

    public static function getFixedExpensesPaid(): array
    {
        $expensesPaid = Expense::whereYear('due_date', Carbon::now()->year)
            ->whereMonth('due_date', Carbon::now()->month)
            ->where('type', 'fixo')
            ->where('status', 'pago')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc')
            ->get();

        $expensesPending = Expense::whereYear('due_date', Carbon::now()->year)
            ->where('type', 'fixo')
            ->where('status', 'pendente')
            ->where('user_id', Auth::user()->id)
            ->orderBy('due_date', 'desc')
            ->get();

        $data = [
            'expenses_paid'   => $expensesPaid,
            'expenses_peding' => $expensesPending
        ];

        return $data;
    }

    public static function getTotalFixedExpensesPaid(): string
    {
        $expensesPaid = Expense::whereYear('due_date', Carbon::now()->year)
            ->whereMonth('due_date', Carbon::now()->month)
            ->where('type', 'fixo')
            ->where('status', 'pago')
            ->where('user_id', Auth::user()->id)
            ->get();

        $values = [];

        foreach ($expensesPaid as $expensePaid) {
            array_push($values, $expensePaid->value);
        }

        return FormatCurrency::getFormatCurrency(array_sum($values));
    }

    public static function getTotalFixedExpensesPeding(): string
    {
        $expensesPeding = Expense::whereYear('due_date', Carbon::now()->year)
            ->where('type', 'fixo')
            ->where('status', 'pendente')
            ->where('user_id', Auth::user()->id)
            ->get();

        $values = [];

        foreach ($expensesPeding as $expensePeding) {
            array_push($values, $expensePeding->value);
        }

        return FormatCurrency::getFormatCurrency(array_sum($values));
    }

    public static function getFixedExpensesTotalArrears(): string
    {
        $expensesPedingArrears = Expense::where('type', 'fixo')
            ->where('status', 'pendente')
            ->whereYear('due_date', Carbon::now()->year)
            ->whereMonth('due_date', '<=', Carbon::now()->month)
            ->where('user_id', Auth::user()->id)
            // ->whereDay('due_date', '<=', Carbon::now()->day)
            ->get();

        $values = [];

        foreach ($expensesPedingArrears as $expensePedingArrears) {
            array_push($values, $expensePedingArrears->value);
        }

        return FormatCurrency::getFormatCurrency(array_sum($values));
    }

    public static function getMetaMonthCurrent()
    {
        $uberMonthCurrent = Expense::whereRelation('category', 'slug', 'uber')->where('user_id', Auth::user()->id)->whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month);

        $meta = Meta::whereHas('category', function ($query) {
            $query->where('slug', 'uber');
        })->where('year', Carbon::now()->year)
            ->where('month', Carbon::now()->month)
            ->first();

        return $meta;
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function meanPayment(): BelongsTo
    {
        return $this->belongsTo(MeanPayment::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}

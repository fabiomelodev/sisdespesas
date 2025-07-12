<?php

namespace App\Models;

use App\Helpers\FormatCurrency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
            $model->user_id = Auth::user()->id;
        });

        static::updating(function ($model) {
            $slug = strip_tags($model->slug);
            $model->slug = Str::slug($slug);
            $model->user_id = Auth::user()->id;
        });
    }

    public static function getTotalBankValueCurrentMonth($month, $year)
    {
        return Bank::get()
            ->map(function ($bank) use ($month, $year) {
                $expenses = $bank->immediateExpenses()
                    ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
                    ->where('status', 'pago')
                    ->whereMonth('pay_day', $month)
                    ->whereYear('pay_day', $year);

                $expensesTotalValue = $expenses->sum('value');

                $ubersTotalValue = $bank->ubers()
                    ->whereMonth('pay_day', $month)
                    ->whereYear('pay_day', $year)
                    ->sum('value');

                $expenses = $expensesTotalValue + $ubersTotalValue;

                $depositsTotalValue = $bank->deposits()
                    ->where('status', 1)
                    ->whereMonth('entry_date', $month)
                    ->whereYear('entry_date', $year)
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
    }

    public function immediateExpenses(): HasMany
    {
        return $this->hasMany(ImmediateExpense::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function ubers(): HasMany
    {
        return $this->hasMany(Uber::class);
    }

    public function typeInvestments(): HasMany
    {
        return $this->hasMany(TypeInvestment::class);
    }

    public function CardCredits(): HasMany
    {
        return $this->hasMany(CardCredit::class);
    }
}

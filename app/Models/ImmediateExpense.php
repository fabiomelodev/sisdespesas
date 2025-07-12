<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImmediateExpense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'pay_day' => 'datetime',
        'due_date' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if ($model->type === 'inscontante') {
                $model->status = 'pago';
            }
        });

        static::updating(function ($model) {
            if ($model->type === 'inscontante') {
                $model->status = 'pago';
            }
        });
    }

    public static function getExpensesFixedPedingCurrentMonth($month, $year)
    {
        return ImmediateExpense::whereMonth('due_date', $month)
            ->whereYear('due_date', $year)
            ->where('type', 'fixo')
            ->where('status', 'pendente')
            ->get();
    }

    public static function getExpensesFixedPaidCurrentMonth($month, $year)
    {
        return ImmediateExpense::whereMonth('pay_day', $month)
            ->whereYear('pay_day', $year)
            ->where('type', 'fixo')
            ->where('status', 'pago')
            ->get();
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
}

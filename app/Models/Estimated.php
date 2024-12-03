<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimated extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'deposits' => 'array',
        'expenses' => 'array'
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->id_date = $model->month . $model->year;

            $deposit_values = [];

            foreach ($model->deposits as $deposit) {
                array_push($deposit_values, $deposit['value']);
            }

            $model->deposit_total = array_sum($deposit_values);

            $expense_values = [];

            foreach ($model->expenses as $expense) {
                array_push($expense_values, $expense['value']);
            }

            $model->expense_total = array_sum($expense_values);

            $model->remaining = $model->deposit_total > $model->expense_total ? $model->deposit_total - $model->expense_total : $model->expense_total - $model->deposit_total;
        });

        static::updating(function ($model) {
            $model->id_date = $model->month . $model->year;

            $deposit_values = [];

            foreach ($model->deposits as $deposit) {
                array_push($deposit_values, $deposit['value']);
            }

            $model->deposit_total = array_sum($deposit_values);

            $expense_values = [];

            foreach ($model->expenses as $expense) {
                array_push($expense_values, $expense['value']);
            }

            $model->expense_total = array_sum($expense_values);

            $model->remaining = $model->deposit_total > $model->expense_total ? $model->deposit_total - $model->expense_total : $model->expense_total - $model->deposit_total;
        });
    }
}

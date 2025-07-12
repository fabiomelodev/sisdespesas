<?php

namespace App\Models;

use App\Helpers\FormatCurrency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Meta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
    }

    public static function getMetasByCategoryCurrentMonth($month, $year)
    {
        return Meta::where('month', $month)
            ->where('year', $year)
            ->get()
            ->map(function ($meta) use ($month, $year) {
                if ($meta->category()->first()->slug == 'uber') {
                    $expensesValue = $meta->category()
                        ->first()
                        ->ubers()
                        ->whereMonth('pay_day', $month)
                        ->whereYear('pay_day', $year)->sum('value');
                } else {
                    $expensesValue = $meta->category()
                        ->first()
                        ->immediateExpenses()
                        ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
                        ->whereMonth('pay_day', $month)
                        ->whereYear('pay_day', $year)
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
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

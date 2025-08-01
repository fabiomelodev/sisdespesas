<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Category extends Model
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

    public static function getCategoriesMetas()
    {
        $categoriesMetas = Category::join('expenses', 'categories.id', '=', 'expenses.category_id')
            ->selectRaw('categories.title, SUM(expenses.value) as total')
            ->groupBy('categories.id')
            ->join('metas', 'categories.id', 'metas.category_id')
            ->selectRaw('metas.value as meta_value')
            ->selectRaw('metas.month as meta_month')
            ->groupBy('metas.id')
            ->whereMonth('expenses.pay_day', Carbon::now()->month)
            ->where('metas.year', Carbon::now()->year)
            ->where('metas.month', Carbon::now()->month)
            ->where('expenses.user_id', Auth::user()->id)
            ->where('metas.user_id', Auth::user()->id)
            ->get();

        return $categoriesMetas;
    }

    public static function getCategoryMeta(string $categorySlug = null)
    {
        return Category::join('ubers', 'categories.id', '=', 'ubers.category_id')
            ->selectRaw('categories.title, SUM(ubers.value) as total')
            ->groupBy('categories.id')
            ->join('metas', 'categories.id', 'metas.category_id')
            ->selectRaw('metas.value as meta_value')
            ->selectRaw('metas.month as meta_month')
            ->groupBy('metas.id')
            ->whereMonth('ubers.pay_day', Carbon::now()->month)
            ->where('metas.year', Carbon::now()->year)
            ->where('metas.month', Carbon::now()->month)
            ->where('ubers.user_id', Auth::user()->id)
            ->where('metas.user_id', Auth::user()->id)
            ->where('categories.slug', $categorySlug)
            ->first();
    }

    public static function getTotalCategoriesImmediateExpensesCurrentMonth($month, $year)
    {
        return ImmediateExpense::join('categories', 'immediate_expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.title, SUM(immediate_expenses.value) as total')
            ->selectRaw('categories.id as category_id')
            ->whereHas('meanPayment', fn(Builder $query) => $query->whereNot('slug', 'credito'))
            ->when($month != null, function (Builder $query) use ($month, $year) {
                return $query->whereMonth('immediate_expenses.pay_day', $month);
            })->groupBy('categories.id')
            ->when($month != null, function (Builder $query) use ($month, $year) {
                return $query->whereYear('immediate_expenses.pay_day', $year);
            })->groupBy('categories.id')
            ->orderBy('title', 'asc')
            ->get();
    }

    public function credits(): HasMany
    {
        return $this->hasMany(Credit::class);
    }

    public function immediateExpenses(): HasMany
    {
        return $this->hasMany(ImmediateExpense::class);
    }

    public function ubers(): HasMany
    {
        return $this->hasMany(Uber::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Uber extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;

            $category = Category::where('slug', 'uber')->first();

            $model->category_id = $category->id;
        });

        static::updating(function ($model) {
            $model->user_id = Auth::user()->id;

            $category = Category::where('slug', 'uber')->first();

            $model->category_id = $category->id;
        });
    }

    public static function getMetaMonthCurrent()
    {
        $uberMonthCurrent = Uber::where('user_id', Auth::user()->id)->whereYear('pay_day', Carbon::now()->year)->whereMonth('pay_day', Carbon::now()->month);

        $uberCategory = Category::where('slug', 'uber')->first();

        $meta = Meta::whereHas('category', function ($query) {
            $query->where('slug', 'uber');
        })->where('year', Carbon::now()->year)
            ->where('month', Carbon::now()->month)
            ->first();

        return $meta;
    }

    public static function getMetaByDate($month, $year)
    {
        return Meta::whereHas('category', function ($query) {
            $query->where('slug', 'uber');
        })->where('year', $year)
            ->where('month', $month)
            ->first();
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class);
    }
}

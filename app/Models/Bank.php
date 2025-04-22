<?php

namespace App\Models;

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

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
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

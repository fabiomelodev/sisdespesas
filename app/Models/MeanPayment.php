<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MeanPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });

        static::updating(function ($model) {
            $slug = strip_tags($model->slug);
            $model->slug = Str::slug($slug);
        });
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}

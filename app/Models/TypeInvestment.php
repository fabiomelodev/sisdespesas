<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TypeInvestment extends Model
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

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }
}

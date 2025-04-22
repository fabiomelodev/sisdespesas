<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardCredit extends Model
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}

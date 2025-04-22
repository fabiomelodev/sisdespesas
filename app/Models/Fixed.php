<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Fixed extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($fixed) {
            $fixed->user_id = Auth::user()->id;

            $ref = Str::slug($fixed->title . $fixed->due_date);

            $fixed->ref = $ref;
        });

        static::updating(function ($fixed) {
            $fixed->user_id = Auth::user()->id;

            $ref = Str::slug($fixed->title . $fixed->due_date);

            $fixed->ref = $ref;
        });
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

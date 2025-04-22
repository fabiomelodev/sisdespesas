<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function typeInvestment(): BelongsTo
    {
        return $this->belongsTo(TypeInvestment::class);
    }
}

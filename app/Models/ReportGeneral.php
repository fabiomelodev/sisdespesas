<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportGeneral extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = $model->month . '-' . $model->year;
        });

        static::updating(function ($model) {
            $model->code = $model->month . '-' . $model->year;
        });
    }
}

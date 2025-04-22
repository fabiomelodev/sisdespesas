<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Credit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
            $model->user_id = Auth::user()->id;

            $number_installments = $model->number_installments;

            if ($model->type == 'parcelado') {
                for ($i = 2; $i <= $model->number_installments; $i++) {
                    $credit = Credit::create([
                        'title'               => $model->title,
                        'slug'                => $model->slug,
                        'value'               => $model->value,
                        'pay_day'             => $model->pay_day,
                        'type'                => $model->type,
                        'current_pensionem'   => $i,
                        'invoice_id'          => (int) $model->invoice_id,
                        'user_id'             => $model->user_id,
                    ]);

                    $credit->number_installments = $model->number_installments;

                    $credit->save();
                }
            }
        });

        static::updating(function ($model) {
            $slug = strip_tags($model->slug);
            $model->slug = Str::slug($slug);
            $model->user_id = Auth::user()->id;
        });
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

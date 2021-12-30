<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrineScreenBook extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'date',
        'reagent_brand',
        'reagent_type',
        'quantity',
        'negative',
        'positive',
        'remain',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

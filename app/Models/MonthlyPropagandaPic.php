<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyPropagandaPic extends Model
{
    protected $fillable = [
        'monthly_propaganda_id',
        'pic',
        'pic_desc',
    ];

    public function monthly_propaganda()
    {
        return $this->belongsTo(MonthlyPropaganda::class);
    }
}

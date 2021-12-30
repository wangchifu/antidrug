<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrineScreenWorkMember extends Model
{
    protected $fillable = [
        'urine_screen_work_id',
        'class',
        'number',
        'name',
        'sex',
    ];

    public function urine_screen_work()
    {
        return $this->belongsTo(UrineScreenWork::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialMember extends Model
{
    protected $fillable = [
        'special_id',
        'class',
        'number',
        'name',
        'sex',
        'special_type',
        'filename',
        'note',
    ];

    public function special()
    {
        return $this->belongsTo(Special::class);
    }
}

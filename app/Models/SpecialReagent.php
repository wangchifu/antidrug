<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialReagent extends Model
{
    protected $fillable = [
        'special_id',
        'name',
        'sex',
        'depart',
        'date',
        'reagent_brand',
        'reagent_type',
        'result',
        'note',
    ];
}

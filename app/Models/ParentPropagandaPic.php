<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentPropagandaPic extends Model
{
    protected $fillable = [
        'parent_propaganda_id',
        'pic',
        'pic_desc',
    ];
}

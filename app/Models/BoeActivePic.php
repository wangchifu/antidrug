<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoeActivePic extends Model
{
    protected $fillable = [
        'boe_active_id',
        'pic',
        'pic_desc',
    ];
}

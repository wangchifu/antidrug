<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterActivePic extends Model
{
    protected $fillable = [
        'center_active_id',
        'pic',
        'pic_desc',
    ];
}

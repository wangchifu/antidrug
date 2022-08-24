<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TzuchiPropagandaPic extends Model
{
    use HasFactory;
    protected $fillable = [
        'tzuchi_propaganda_id',
        'pic',
        'pic_desc',
    ];
}

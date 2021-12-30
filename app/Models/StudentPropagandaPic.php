<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPropagandaPic extends Model
{
    protected $fillable = [
        'student_propaganda_id',
        'pic',
        'pic_desc',
    ];
}

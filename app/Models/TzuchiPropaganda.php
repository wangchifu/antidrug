<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TzuchiPropaganda extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'school_code',
        'title',
        'lecture',
        'date',
        'place',
        'teacher_times',
        'student_times',
        'report',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pics()
    {
        return $this->hasMany(TzuchiPropagandaPic::class);
    }
}

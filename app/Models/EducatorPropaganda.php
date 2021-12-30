<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducatorPropaganda extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'title',
        'lecture',
        'date',
        'place',
        'teacher_times',
        'student_times',
        'content',
        'feedback',
        'q_1_1',
        'q_1_2',
        'q_1_3',
        'q_1_4',
        'q_1_5',
        'q_2_1',
        'q_2_2',
        'q_2_3',
        'q_2_4',
        'q_2_5',
        'q_3_1',
        'q_3_2',
        'q_3_3',
        'q_3_4',
        'q_3_5',
        'q_4_1',
        'q_4_2',
        'q_4_3',
        'q_4_4',
        'q_4_5',
        'q_5_1',
        'q_5_2',
        'q_5_3',
        'q_5_4',
        'q_5_5',
        'q_6_1',
        'q_6_2',
        'q_6_3',
        'q_6_4',
        'q_6_5',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pics()
    {
        return $this->hasMany(EducatorPropagandaPic::class);
    }
}

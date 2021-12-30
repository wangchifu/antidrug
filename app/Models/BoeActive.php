<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoeActive extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'title',
        'date',
        'object',
        'type',
        'personnel',
        'place',
        'person_times',
        'times',
        'content',
        'result',
        'money_source',
        'money',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pics()
    {
        return $this->hasMany(BoeActivePic::class);
    }
}

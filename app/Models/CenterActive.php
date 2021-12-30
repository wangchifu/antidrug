<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterActive extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'title',
        'date',
        'place',
        'person_times',
        'filename',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pics()
    {
        return $this->hasMany(CenterActivePic::class);
    }
}

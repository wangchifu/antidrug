<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'date',
        'yes_no',
        'meeting_filename',
        'signin_filename',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(SpecialMember::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrineScreenWork extends Model
{
    protected $fillable = [
        'user_id',
        'school_code',
        'date',
        'positive_boy',
        'positive_girl',
        'confirm_positive_boy',
        'confirm_positive_girl',
        'chun_hui',
        'filename',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(UrineScreenWorkMember::class);
    }
}

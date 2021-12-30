<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'year',
        'school_code',
        'user_id',
        'file',
        'status',
        'review_user_id',
        'review_desc',
        'reviewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function review_user()
    {
        return $this->belongsTo(User::class,'review_user_id','id');
    }
}

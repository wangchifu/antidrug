<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'file_desc',
        'pic_desc',
        'link',
        'user_id',
        'views',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

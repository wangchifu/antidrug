<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    protected $fillable = [
        'website_name',
        'address',
        'telephone',
        'fax',
        'contact_person1',
        'contact_email1',
        'contact_person2',
        'contact_email2',
    ];
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'college',
        'year',
        'subject',
        'description',
        // add all other fields
    ];
}

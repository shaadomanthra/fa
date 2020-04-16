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
        'user_id',
        'comment',
        'status',
        // add all other fields
    ];

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

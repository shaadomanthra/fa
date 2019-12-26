<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
    	'slug',
        'user_id',
        'content',
        'title',
        'description',
        'status'
        // add all other fields
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

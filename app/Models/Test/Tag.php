<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
        // add all other fields
    ];

     public function tests()
    {
        return $this->belongsToMany('App\Models\Test\Test');
    }

}

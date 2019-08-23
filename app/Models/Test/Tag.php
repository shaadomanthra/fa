<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'value',
        // add all other fields
    ];

    public function fillup()
    {
        return $this->belongsToMany('App\Models\Test\Fillup');
    }

    public function mcq()
    {
        return $this->belongsToMany('App\Models\Test\Mcq');
    }

}

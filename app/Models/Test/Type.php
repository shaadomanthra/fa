<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        // add all other fields
    ];

    public function tests()
    {
        return $this->belongsTo('App\Models\Test\Test');
    }
}

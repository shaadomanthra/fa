<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'test_id',
        'name',
        'slug',
        'instructions',
        'seek_time',
        'type',
        // add all other fields
    ];

    public function test()
    {
        return $this->belongsTo('App\Models\Test\Test');
    }

    public function extracts()
    {
        return $this->hasMany('App\Models\Test\Extract');
    }

}

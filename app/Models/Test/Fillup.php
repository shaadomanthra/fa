<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Fillup extends Model
{
    protected $fillable = [
        'test_id',
    	'extract_id',
        'label',
        'prefix',
        'answer',
        'suffix',
        'qno',
        'sno',
        // add all other fields
    ];

    public function test()
    {
        return $this->belongsTo('App\Models\Test\Test');
    }

    public function extract()
    {
        return $this->belongsTo('App\Models\Test\Extract');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Test\Tag');
    }
}

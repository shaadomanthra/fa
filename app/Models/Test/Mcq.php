<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    protected $fillable = [
        'test_id',
        'extract_id',
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer',
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

}

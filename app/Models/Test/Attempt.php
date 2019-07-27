<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'test_id',
        'user_id',
        'mcq_id',
        'fillup_id',
        'qno',
        'response',
        'answer',
        'accuracy',
        // add all other fields
    ];

    public function test()
    {
        return $this->belongsTo('App\Models\Test\Test');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fillup()
    {
        return $this->belongsTo('App\Models\Test\Fillup');
    }
    
    public function mcq()
    {
        return $this->belongsTo('App\Models\Test\Mcq');
    }

}

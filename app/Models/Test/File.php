<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
     protected $table = 'attempts';

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

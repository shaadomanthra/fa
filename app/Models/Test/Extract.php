<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    protected $fillable = [
        'test_id',
        'section_id',
        'name',
        'seek_time',
        'text',
        'glance_time',
        'layout',

        // add all other fields
    ];

  	public function section()
    {
        return $this->belongsTo('App\Models\Test\Section');
    }

    public function fillup()
    {
        return $this->hasMany('App\Models\Test\Fillup');
    }

    public function mcq()
    {
        return $this->hasMany('App\Models\Test\Mcq');
    }

    

    public function fillup_order() {
        return $this->fillup()->orderBy('sno','asc');
    }

    public function mcq_order() {
        return $this->mcq()->orderBy('qno','asc');
    }
}

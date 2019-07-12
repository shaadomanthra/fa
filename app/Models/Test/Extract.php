<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    protected $fillable = [
        'test_id',
        'section_id',
        'name',
        'file',
        'text',
        'glance_time',
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
}

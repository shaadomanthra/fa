<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'instructions',
        'file',
        'marks',
        'test_time',
        'status',
        'group_id',
        'type_id',
        // add all other fields
    ];

    

    public function testtype()
    {
        return $this->belongsTo('App\Models\Test\Type','type_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Test\Category');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Test\Section');
    }

    public function group()
    {
        return $this->belongsTo('App\Models\Test\Group');
    }
    
}

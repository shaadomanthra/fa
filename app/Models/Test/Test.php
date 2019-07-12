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
        'type',
        // add all other fields
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Test\Tag');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Test\Category');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Test\Section');
    }
    
}

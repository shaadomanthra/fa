<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'status',
        // add all other fields
    ];

     public function groups()
    {
        return $this->belongsToMany('App\Models\Test\Group');
    }
}

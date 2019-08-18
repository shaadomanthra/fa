<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'expiry',
        'status',
        'user_id',
        'unlimited',
        // add all other fields
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product\Product');
    }
}

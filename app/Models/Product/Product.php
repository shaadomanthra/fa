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

    public function order($user=null){
        if(!$user)
            return null;

        $order = $user->orders()->where('product_id',$this->id)->where('status',1)->orderBy('id','desc')->first();
        return $order;
    }
}

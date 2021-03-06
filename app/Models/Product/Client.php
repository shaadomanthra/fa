<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'domains',
        'config',
        'user_id',
        'status',
        // add all other fields
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App\Models\Gre;

use Illuminate\Database\Eloquent\Model;

class Grecategory extends Model
{
    protected $fillable = [
    	'parent',
        'hash',
        'item',
        'value',
        'information',
        // add all other fields
    ];
    protected $table = 'grecategories';
}

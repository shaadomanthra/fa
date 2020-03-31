<?php

namespace App\Models\Gre;

use Illuminate\Database\Eloquent\Model;

class Grepassage extends Model
{
    protected $fillable = [
    	'grecategory_id',
        'hash',
        'passage',
        'status',
        'pno',
        // add all other fields
    ];
    protected $table = 'grepassages';
}

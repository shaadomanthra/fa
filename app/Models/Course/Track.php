<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
    	'name',
        'slug',
        'description',
        'status',
        'created_at',
        'updated_at'

        // add all other fields
    ];

    public $timestamps = true;
}

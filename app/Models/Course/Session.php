<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
    	'name',
        'slug',
        'description',
        'faculty',
        'course_id',
        'user_id',
        'meeting_id',
        'meeting_password',
        'meeting_url',
        'status',
        'created_at',
        'updated_at'

        // add all other fields
    ];

    public $timestamps = true;
}

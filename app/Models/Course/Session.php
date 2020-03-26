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
        'track_id',
        'user_id',
        'meeting_id',
        'meeting_password',
        'meeting_url',
        'status'
        // add all other fields
    ];


     public function track()
    {
        return $this->belongsTo('App\Models\Course\Track');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

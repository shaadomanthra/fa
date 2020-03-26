<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
    	'name',
        'slug',
        'description',
        'status'
    ];


    public function sessions()
    {
        return $this->hasMany('App\Models\Course\Session');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}

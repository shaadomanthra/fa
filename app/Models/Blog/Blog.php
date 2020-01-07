<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'body',
        'test',
        'conlusion',
        'schedule',
        'status',
        'user_id',
        'meta_title',
        'meta_description',

        // add all other fields
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\Label');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Blog\Label');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Models\Blog\Collection');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Blog\Collection');
    }
}

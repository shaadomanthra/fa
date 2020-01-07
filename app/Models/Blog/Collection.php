<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'image',
        'meta_title',
        'meta_description',

        // add all other fields
    ];


    public function blogs()
    {
        return $this->belongsTo('App\Models\Blog\Blog');
    }
}

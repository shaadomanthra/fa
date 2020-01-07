<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'slug',
        'name',

        // add all other fields
    ];

    public function blogs()
    {
        return $this->belongsTo('App\Models\Blog\Blog');
    }
}

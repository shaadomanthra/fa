<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'course',
        'mode',
        'module',
        'batch',
        'source',
        'stage',
        'center',
        'contacted',
        'status',
        'user_id',
        'created_at'

        // add all other fields
    ];

    public $timestamps = true;

    public function followups()
    {
        return $this->hasMany('App\Models\Admin\Followup');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

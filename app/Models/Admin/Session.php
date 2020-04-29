<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'id',
        'ip_address',
        'payload',
        'user_agent',
        'user_id',
        'last_activity'

        // add all other fields
    ];
      public $timestamps = false;
}

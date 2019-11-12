<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $fillable = [
        'user_id',
        'prospect_id',
        'comment',
        'schedule',
        'state',

        // add all other fields
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function prospect()
    {
        return $this->belongsTo('App\Models\Admin\Prospect');
    }
}

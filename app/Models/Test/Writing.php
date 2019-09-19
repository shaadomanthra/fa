<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Writing extends Model
{
    protected $fillable = [
        'user_id',
        'attempt_id',
        'status',
        'notify'

        // add all other fields
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attempt()
    {
        return $this->belongsTo('App\Models\Test\Attempt');
    }
}

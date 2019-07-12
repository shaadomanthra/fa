<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'user_id',
        'mcq_id',
        'fillup_id',
        'qno',
        'response',
        'answer',
        'accuracy',
        // add all other fields
    ];

}

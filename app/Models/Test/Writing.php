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

     $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('attempt_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('notify')->default(0);
}

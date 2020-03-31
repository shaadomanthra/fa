<?php

namespace App\Models\Gre;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gre\Grepassage;


class Grequestion extends Model
{
    protected $fillable = [
    	'grecategory_id',
        'qno',
        'question',
        'a',
        'b',
        'c',
        'd',
        'e',
        'answer',
        'explanation',
        'grepassage_id',
        'expert_level',
        'hash'
        // add all other fields
    ];

    protected $table = 'grequestions';

    public function passage()
    {
        if($this->grepassage_id)
        return Grepassage::where('id',$this->grepassage_id)->first()->passage;
        else
            return null;
    }
}

<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Model;
use App\Models\Test\Test;

class Attempt extends Model
{
    protected $fillable = [
        'test_id',
        'user_id',
        'mcq_id',
        'fillup_id',
        'qno',
        'response',
        'answer',
        'accuracy',
        // add all other fields
    ];


    public function test()
    {
        return $this->belongsTo('App\Models\Test\Test');
    }

    public function getTest($id)
    {   
        $test = Test::where('id',$id)->first();
        return $test;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function writing()
    {
        return $this->hasOne('App\Models\Test\Writing');
    }

    public function fillup()
    {
        return $this->belongsTo('App\Models\Test\Fillup');
    }
    
    public function mcq()
    {
        return $this->belongsTo('App\Models\Test\Mcq');
    }


    public function reading_band($score){
        if($score==39 || $score ==40)
            $band = 9;
        else if($score==37 || $score ==38)
            $band = 8.5;
        else if($score==35 || $score ==36)
            $band = 8;
        else if($score>=33 && $score <=34)
            $band = 7.5;
        else if($score>=30 && $score <=32)
            $band = 7;
        else if($score>=27 && $score <=29)
            $band = 6.5;
        else if($score>=23 && $score <=26)
            $band = 6;
        else if($score>=19 && $score <=22)
            $band = 5.5;
        else if($score>=15 && $score <=18)
            $band = 5;
        else if($score>=13 && $score <=14)
            $band = 4.5;
        else if($score>=10 && $score <=12)
            $band = 4;
        else if($score>=8 && $score <=9)
            $band = 3.5;
        else if($score>=6 && $score <=7)
            $band = 3;
        else if($score>=4 && $score <=5)
            $band = 2.5;
        else if($score>=2 && $score <=3)
            $band = 2;
        else 
            $band =0;
        return $band;

    }

    public function listening_band($score){

        if($score==39 || $score ==40)
            $band = 9;
        else if($score==37 || $score ==38)
            $band = 8.5;
        else if($score==35 || $score ==36)
            $band = 8;
        else if($score>=32 && $score <=34)
            $band = 7.5;
        else if($score>=30 && $score <=31)
            $band = 7;
        else if($score>=26 && $score <=29)
            $band = 6.5;
        else if($score>=23 && $score <=25)
            $band = 6;
        else if($score>=18 && $score <=22)
            $band = 5.5;
        else if($score>=16 && $score <=17)
            $band = 5;
        else if($score>=13 && $score <=15)
            $band = 4.5;
        else if($score>=11 && $score <=12)
            $band = 4;
        else if($score>=8 && $score <=10)
            $band = 3.5;
        else if($score>=5 && $score <=7)
            $band = 3;
        else if($score==3 && $score ==4)
            $band = 2.5;
        else if($score==2 )
            $band = 2;
        else if($score==1)
            $band = 1;
        else
            $band =0;
        return $band;

    }

}

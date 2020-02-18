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

    public function getCountUser($d){
        $c=array('all'=>0,'enquiry'=>0,'demo'=>0,'enrolled'=>0);
        $sum =0;
        $data = $d->groupBy('stage');
        foreach($data as $item => $value){
            $c[$item] = count($value);
            $sum = $sum + $c[$item];
        }

        $c['all'] = $sum;

        return $c;
    }

    public function getCount($user_id=null){
        if($user_id){
            $counter = $this->getCountUser($this->where('user_id',$user_id)->get());
        }else{
            $data = $this->get()->groupBy('user_id');
            $counter = $this->getCountUser($this->get());
            foreach($data as $item=>$d){
                $counter[$item] = $this->getCountUser($d);
            }
        }
        return $counter;
    }
}

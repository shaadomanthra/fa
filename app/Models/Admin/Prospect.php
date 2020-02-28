<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;

class Prospect extends Model
{
    use Sortable;
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


    public function getDataDate($item,$range){
        if($range=='thisweek'){
            return $item->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }else if($range=='lastweek'){
            $previous_week = strtotime("-1 week +1 day");
             $start_week = strtotime("last sunday midnight",$previous_week);
             $end_week = strtotime("next saturday",$start_week);
             $start_week = date("Y-m-d",$start_week);
             $end_week = date("Y-m-d",$end_week);
            return $item->whereBetween('created_at', [$start_week, $end_week]);
        }else if($range=='thismonth'){
              return $item->whereMonth('created_at', Carbon::now()->month);
        }else if($range=='lastmonth'){
            return $item->whereMonth('created_at', '=', Carbon::now()->subMonth()->month);
        }else if($range=='thisyear'){
            return $item->whereYear('created_at', Carbon::now()->year);
        }else if($range=='lastyear'){
            return $item->whereYear('created_at', date('Y', strtotime('-1 year')));
        }else{
            return $item;
        }
    }

    

    public function getCount($user_id=null,$range=null){
        if($user_id){
            $counter = $this->getCountUser($this->getDataDate($this->where('user_id',$user_id),$range)->get());
        }else{
            $data = $this->getDataDate($this,$range)->get()->groupBy('user_id');
            $counter = $this->getCountUser($this->getDataDate($this,$range)->get());
            foreach($data as $item=>$d){
                $counter[$item] = $this->getCountUser($d);
            }
        }
        return $counter;
    }
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Followup extends Model
{
    use Sortable;
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

    public function getCountFollowup($d){
        $c=array('prospects'=>0,'followup'=>0,'open'=>0,'incomplete'=>0);
        $sum =0;
        $data = $d->groupBy('prospect_id');
        $c['prospects'] = count($data);
        $c['followup'] = count($d);

        foreach($d as $item ){
            if($item->state==1){
                $c['open']++;
                $date = \Carbon\Carbon::parse($item->schedule)->format('Y-m-d');
                $now = \Carbon\Carbon::now()->format('Y-m-d');
                if($date < $now)
                    $c['incomplete']++;
            }
        }
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
            $counter = $this->getCountFollowup($this->getDataDate($this->where('user_id',$user_id),$range)->get());
        }else{
            $data = $this->getDataDate($this,$range)->get()->groupBy('user_id');
            $counter = $this->getCountFollowup($this->getDataDate($this,$range)->get());
            foreach($data as $item=>$d){
                $counter[$item] = $this->getCountFollowup($d);
            }
        }
        return $counter;
    }
}

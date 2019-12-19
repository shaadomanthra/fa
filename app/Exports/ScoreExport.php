<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class ScoreExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$users = request()->session()->get('users');
    	$score = request()->session()->get('score');
    	$ids_ordered = request()->session()->get('ids_ordered');

    	$ids = implode(',', $ids_ordered);

    	$usr = User::whereIn('id', $ids_ordered)
		 ->orderByRaw(DB::raw("FIELD(id, $ids)"))
		 ->get();
		 

        foreach($usr as $k=>$u){
            if(isset($usd[$k])){
                
            }
            
    		unset($usr[$k]->created_at);
    		unset($usr[$k]->updated_at);
    		unset($usr[$k]->password);
    		unset($usr[$k]->remember_token);
    		unset($usr[$k]->sms_token);
    		unset($usr[$k]->lastlogin_at);
    		unset($usr[$k]->admin);
    		unset($usr[$k]->email_verified_at);
    		unset($usr[$k]->status);
    		unset($usr[$k]->auto_password);
    		unset($usr[$k]->activation_token);
    		unset($usr[$k]->idno);
    		unset($usr[$k]->user_id);
    		$usr[$k]->score= $score[$u->id];
    		
    	}

    	$ux = new User();
    	$ux->id = "ID";
    	$ux->name = "Name";
    	$ux->email = "Email";
    	$ux->phone = "Phone";
    	$ux->score = "Score";

    	unset($ux->created_at);
    	unset($ux->updated_at);
    	unset($ux->password);
    	unset($ux->remember_token);
    	unset($ux->sms_token);
    	unset($ux->lastlogin_at);
    	unset($ux->admin);
    	unset($ux->email_verified_at);
    	unset($ux->status);
    	unset($ux->auto_password);
    	unset($ux->activation_token);
    	unset($ux->idno);
    	unset($ux->user_id);
    	$usr->prepend($ux);

        return $usr;
    }
}

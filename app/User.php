<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','lastlogin_at','status',
        'activation_token','sms_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isAdmin(){
        if($this->admin)
            return true;
        else
            return false;
    }

    public function orders(){
        return $this->hasMany('App\Models\Product\Order');
    }

    public function tests(){
        $test_id = DB::table('attempts')
                ->select('test_id')
                ->where('user_id', $this->id)
                ->orderBy('id','desc')
                ->pluck('test_id')->toArray();
        $tests = Test::whereIn('id',$test_id)->get();
        return $tests;
    }

    public function productAccess($product){
        $order = $this->orders()->where('product_id',$product)->orderBy('id','desc')->first();
        if($order){
            if(strtotime($order->expiry) > strtotime(date('Y-m-d')))
                return true;
            else
                return false;
        }else
            return false;
        
    }


}

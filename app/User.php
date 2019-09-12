<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;
use App\Models\Test\Attempt;

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

    public function attempts(){
        return $this->hasMany('App\Models\Test\Attempt');

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

    public function testAccess($id){
        $order = $this->orders()->where('product_id',$id)->orWhere('test_id',$id)->orderBy('id','desc')->first();
        if($order){
            if(strtotime($order->expiry) > strtotime(date('Y-m-d')))
                return true;
            else
                return false;
        }else
            return false;
        
    }

    public function attempt($id){
        $attempt = Attempt::where('test_id',$id)->first();
        if($attempt){
            return true;
        }else
            return false;
        
    }


    public function resend_sms($numbers,$code){
                // Authorisation details.
            $username = "info@firstacademy.in";
    $hash = "5f40765f506a1348748d2adc498e88275b5a046763fd8b948ee289970e1cc938";


        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "FIIRST"; // This is who the message appears to be from.
        
        $message = "Thank you for registering with First Academy. Your verification code is ".$code;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
    }


}

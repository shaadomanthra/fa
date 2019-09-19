<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;
use App\Models\Product\Product;
use App\Models\Product\Order;
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
        'activation_token','sms_token','user_id','idno','admin','auto_password',
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

    public function referral($id)
    {
        $user = $this->find($id);
        return $user;
    }

    public function orders(){
        return $this->hasMany('App\Models\Product\Order');
    }

    public function attempts(){
        return $this->hasMany('App\Models\Test\Attempt');

    }

    public function create_order($user_id,$referral_name,$product_id,$test_id,$validity){
        $order = new Order();
        $order->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);

        $o_check = Order::where('order_id',$order->order_id)->first();
        while($o_check){
            $order->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);
            $o_check = Order::where('order_id',$order->order_id)->first();
            if(!$o_check)
              break;
        }

        $order->user_id = $user_id;
        $order->txn_amount = 0;
        $order->status=1;
        $order->txn_id = '';
        $order->payment_mode = 'REFERRAL';
        $order->txn_id = $referral_name;

        $order->product_id = $product_id;
        $order->test_id = $test_id;

        $valid_till = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") .' + '.($validity*31).' days'));
        $order->expiry = $valid_till;
        $order->save();
    }

    public function hasTest($test_id){
        $order = $this->orders()->where('test_id',$test_id)->orderBy('id','desc')->first();
        return $order;
    }

    public function hasProduct($product_id){
        $order = $this->orders()->where('product_id',$product_id)->orderBy('id','desc')->first();
        return $order;
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
        $order = $this->orders()->where('test_id',$id)->orderBy('id','desc')->first();
        
        if($order){
            if(strtotime($order->expiry) < strtotime(date('Y-m-d'))){
                $test = Test::where('id',$id)->first();
                $products = $test->products->pluck('id')->toArray();
                $orders = $this->orders()->whereIn('product_id',$products)->orderBy('id','desc')->get();
                foreach($orders as $o){
                    if(strtotime($o->expiry) > strtotime(date('Y-m-d')))
                        return true;
                }
            }else{
                return true;
            }
        }

        $order2 = $this->orders()->where('product_id',$id)->orderBy('id','desc')->first();

        if($order2){
            if(strtotime($order2->expiry) > strtotime(date('Y-m-d')))
                return true;
            else
                return false;
        }
        
        return false;
    }

    public function attempt($id){
        $attempt = Attempt::where('test_id',$id)->where('user_id',$this->id)->first();
        if($attempt){
            return true;
        }else
            return false;
        
    }

    public function testscore($user_id,$test_id){
        $attempt = Attempt::where('test_id',$test_id)->where('user_id',$user_id)->get();
        $score =0;
        
        foreach($attempt as $r){
                if($r->accuracy==1)
                  $score++;
        }
        if($score)
        return $score;
        else
            return null;
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

<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'txn_id',
        'payment_mode',
        'bank_txn_id',
        'bank_name',
        'txn_amount',
        'expiry',
        'status',
        // add all other fields
    ];


    public function product(){
        return $this->belongsTo('App\Models\Product\Product');
    }

    public function test(){
        return $this->belongsTo('App\Models\Test\Test');
    }


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function grantaccess($product_id,$test_id,$validity){
        $user = \auth::user();
        
        $this->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);

        $o_check = $this->where('order_id',$this->order_id)->first();
        while($o_check){
            $this->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);
            $o_check = Order::where('order_id',$this->order_id)->first();
            if(!$o_check)
                break;
        }

        $this->user_id = $user->id;
        $this->txn_amount = 0;
        $this->status=1;
        $this->txn_id = '';
        $this->payment_mode = 'FREE';
        $this->product_id = $product_id;
        $this->test_id = $test_id;
        $valid_till = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") .' + '.($validity*31).' days'));
        $this->expiry = $valid_till;
              
        $this->save();
    }
}

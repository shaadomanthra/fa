<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Instamojo as Instamojo;
use App\Models\Product\Product;
use App\Models\Product\Order;
use App\Models\Product\Coupon;
use App\User;

class OrderController extends Controller
{
    /**
     * Checkout page.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout($slug,Request $request){
        $product = Product::where('slug',$slug)->first();
        if($product){
          if(!$product)
            return view('appl.product.order.checkout_invalid');
          else{
              return view('appl.product.order.checkout')->with('product',$product);
          }

        }
    }


    public function instamojo(Request $request){
    $api = new Instamojo\Instamojo('test_43eb01abde88edc5f67120bc66b', 'test_0e4d7ecf73f435abd0236582e93','https://test.instamojo.com/api/1.1/');
    }

    public function instamojo_return(Request $request){
      $api = new Instamojo\Instamojo('test_43eb01abde88edc5f67120bc66b', 'test_0e4d7ecf73f435abd0236582e93','https://test.instamojo.com/api/1.1/');
      try {
            $id = $request->get('payment_request_id');
            //dd($id);
            if($id){
            $response = $api->paymentRequestStatus($id);
            //dd($response);
            }
            else
              echo "input the id";

          if($response['status']=='Completed')
          { 
            $order = Order::where('order_id',$id)->first();
            $user = User::where('id',$order->user_id)->first();
            $product = Product::where('id',$order->product_id)->first();

            $order->payment_mode = $response['payments'][0]['instrument_type'];
            $order->bank_txn_id = $response['payments'][0]['payment_id'];
            $order->bank_name = $response['payments'][0]['billing_instrument'];
            $order->txn_id = $response['payments'][0]['payment_id'];
            if($response['status']=='Completed'){
              $order->status = 1;
            }
            else{
              $order->status = 2;
              
            }
            $order->save();
          }

        if ($response['status']=='Completed') {
          $order->payment_status = 'Successful';
          //Mail::to($user->email)->send(new OrderSuccess($user,$order));
        }
        
        return view('appl.product.order.checkout_success')->with('order',$order);
            
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }


    }



     /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function order(Request $request)
    {
          if($request->type=='instamojo' && $request->txn_amount!=0){

          $api = new Instamojo\Instamojo('test_43eb01abde88edc5f67120bc66b', 'test_0e4d7ecf73f435abd0236582e93','https://test.instamojo.com/api/1.1/');
          try {
            

            if($request->txn_amount<10)
                abort('403','Transaction ammount cannot be < Rs.10');

            $user = \auth::user();
            $o = Order::where('product_id',$request->get('product_id'))
                  ->where('user_id',$user->id)->first();
            $product = Product::where('id',$request->get('product_id'))->first();


            if($o)
            if($o->status == 1 ){
              return view('appl.product.order.checkout_denail')->with('order',$o);

              $rebuy = true;
            }
            
              
            $response = $api->paymentRequestCreate(array(
                  "buyer_name" => $user->name,
                  "purpose" => strip_tags($product->name),
                  "amount" =>  $request->txn_amount,
                  "send_email" => false,
                  "email" => $user->email,
                  "redirect_url" => "https://fa.packetprep.com/order_payment"
                ));

              //dd($response);
              $order = new Order();
              $order->order_id = $response['id'];

              $o_check = Order::where('order_id',$order->order_id)->first();
              while($o_check){
                $response = $api->paymentRequestCreate(array(
                  "buyer_name" => $user->name,
                  "purpose" => strip_tags($product->name),
                  "amount" =>  $request->txn_amount,
                  "send_email" => false,
                  "email" => $user->email,
                  "redirect_url" => "https://fa.packetprep.com/order_payment"
                  ));
                $order->order_id = $response->id;
                $o_check = Order::where('order_id',$order->order_id)->first();
                if(!$o_check)
                  break;
              }

              $order->user_id = $user->id;
              $order->txn_amount = $request->txn_amount;
              $order->status=0;
              $order->product_id = $request->get('product_id');

              
               //dd($order);
              $order->save();
              $order->payment_status = 'Pending';

              return redirect($response['longurl']);

          }
          catch (Exception $e) {
              print('Error: ' . $e->getMessage());
          }



          
        }else{
         $api = new Instamojo\Instamojo('test_43eb01abde88edc5f67120bc66b', 'test_0e4d7ecf73f435abd0236582e93','https://test.instamojo.com/api/1.1/');

          try {
            

            $user = \auth::user();
            $o = Order::where('product_id',$request->get('product_id'))
                  ->where('user_id',$user->id)->first();
            $product = Product::where('id',$request->get('product_id'))->first();
            $coupon = Coupon::where('code',strtoupper($request->get('coupon')))->first();


            if($o)
            if($o->status == 1 ){
              return view('appl.product.order.checkout_denail')->with('order',$o);

              $rebuy = true;
            }

            if(!$coupon){
                $m = "Invalid Coupon Code";
                 return view('appl.product.order.checkout_coupon')->with('message',$m);

            }else{
                if($coupon->status==0){
                   $m = "Coupon Code Expired!";
                 return view('appl.product.order.checkout_coupon')->with('message',$m); 
                }
                
                if(!$coupon->products()->where('id',$product->id)->first()){
                    $m = "Restricted Access - This Copoun cannot be used for this product";
                    return view('appl.product.order.checkout_coupon')->with('message',$m);
                }
            }

              //dd($response);
              $order = new Order();
              $order->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);

              $o_check = Order::where('order_id',$order->order_id)->first();
              while($o_check){
                $order->order_id = 'ORD_'.substr(md5(mt_rand()), 0, 10);
                $o_check = Order::where('order_id',$order->order_id)->first();
                if(!$o_check)
                  break;
              }

              $order->user_id = $user->id;
              $order->txn_amount = 0;
              $order->status=1;
              $order->payment_mode = 'COUPON';
              $order->txn_id = $coupon->code;
              $order->product_id = $request->get('product_id');

              
               //dd($order);
              $order->save();
              $order->payment_status = 'Successful';

              //update coupon
              $coupon->status = 0;
              $coupon->save();
             // Mail::to($user->email)->send(new OrderSuccess($user,$order));

              return view('appl.product.order.checkout_success')->with('order',$order);

          }
          catch (Exception $e) {
              print('Error: ' . $e->getMessage());
          }


        }
        
    }

    
}

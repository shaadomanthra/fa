<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as Obj;
use App\Models\Test\Test;
use App\Models\Test\Attempt;
use App\Models\Product\Order;
use App\Models\Product\Product;

use Illuminate\Support\Facades\Hash;
use App\Mail\usercreate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    /*
        User Controller
    */

    public function __construct(){
        $this->app      =   'user';
        $this->module   =   'user';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {

        $this->authorize('view', $obj);

        $search = $request->search;
        $item = $request->item;
        
        $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->orWhere('email','LIKE',"%{$item}%")
                    ->orWhere('idno','LIKE',"%{$item}%")
                    ->orWhere('phone','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));   
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('app',$this);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obj = new Obj();
        $this->authorize('create', $obj);
        $tests = Test::where('status',1)->get();
        $products = Product::where('status',1)->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('tests',$tests)
                ->with('products',$products)
                ->with('editor',true)
                ->with('app',$this);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, Request $request)
    {
        try{
            
            $password = strtoupper(Str::random(5));

            if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                flash('Invalid Email')->error();
                return redirect()->back()->withInput();;
            }

            if (strlen($request->get('phone'))<10) {
                flash('Invalid phone number (less than 10 digits)')->error();
                return redirect()->back()->withInput();;
            }
            /* create a new entry */
           $user= $obj->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'status'=>$request->get('status'),
            'idno'=>strtoupper($request->get('idno')),
            'user_id'=>\auth::user()->id,
            'activation_token'=>1,
            'sms_token' => 1,
            'password' =>  Hash::make($password),
            'auto_password'=> $password,
        	]);

            $user['password_string'] = $password;
            //send password on mail
        	Mail::to($user->email)->send(new usercreate($user));

            $referral_name = \auth::user()->name;
            // attach tests and products
            $tests = $request->get('tests');
            if($tests)
            foreach($tests as $t){
                $test = Test::where('id',$t)->first();
                $user->create_order($user->id,$referral_name,null,$t,$test->validity);
            }

            $products = $request->get('products');
            if($products)
            foreach($products as $p){
                $product = Product::where('id',$p)->first();
                $user->create_order($user->id,$referral_name,$p,null,$product->validity);
            }

            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.index');
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                flash('Some error in Creating the record')->error();
                 return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('view', $obj);
        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj= Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        $tests = Test::where('status',1)->get();
        $products = Product::where('status',1)->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('tests',$tests)
                ->with('products',$products)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $obj = Obj::where('id',$id)->first();

            $this->authorize('update', $obj);
            
            $obj->update($request->all()); 

            $referral_name = \auth::user()->name;
            // attach tests and products
            $tests = $request->get('tests');
            $products = $request->get('products');

            if(!$tests)
                $tests = [];

            if(!$products)
                $products = [];

            $tst = Test::where('status',1)->get();
            $prd = Product::where('status',1)->get();

            foreach($tst as $ts){
                if($obj->hasTest($ts->id))
                {   
                    if(!in_array($ts->id, $tests)){
                      $order = $obj->orders()->where('test_id',$ts->id)->orderBy('id','desc')->first();
                      $order->delete();  
                    }
                    
                }
            }

            foreach($prd as $pd){
                if($obj->hasProduct($pd->id))
                {   
                    if(!in_array($pd->id, $products)){
                      $order = $obj->orders()->where('product_id',$pd->id)->orderBy('id','desc')->first();
                      $order->delete();  
                    }
                    
                }
            }

            if($tests)
            foreach($tests as $t){
                $test = Test::where('id',$t)->first();
                if(!$obj->hasTest($t))
                    $obj->create_order($obj->id,$referral_name,null,$t,$test->validity);

            }

            
            if($products)
            foreach($products as $p){
                $product = Product::where('id',$p)->first();
                if(!$obj->hasProduct($p))
                $obj->create_order($obj->id,$referral_name,$p,null,$product->validity);
            }


            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.show',$id);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 flash('Some error in updating the record')->error();
                 return redirect()->back()->withInput();
            }
        }
    }


    public function test($user_id,$test_id,Request $request){


        $user = Obj::where('id',$user_id)->first();
        $test = Test::where('id',$test_id)->first();
        $attempt = Attempt::where('test_id',$test_id)->where('user_id',$user_id)->get();
        if($request->get('delete')){
            foreach($attempt as $a){
                $a->delete();
            }
            return redirect()->route($this->module.'.show',$user->id);
        }
        $type = strtolower($test->testtype);
        $score =0;
        if($type !='writing' && $type !='speaking' ){
            foreach($attempt as $r){
                if($r->accuracy==1)
                  $score++;
              }
        }
        
        return view('appl.'.$this->app.'.'.$this->module.'.test')
                ->with('test',$test)
                ->with('user',$user)
                ->with('score',$score)
                ->with('app',$this);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        Order::where('user_id',$obj->id)->delete();
        Attempt::where('user_id',$obj->id)->delete();
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

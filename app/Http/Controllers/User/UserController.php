<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as Obj;
use App\Models\Test\Test;
use App\Models\Test\Attempt;
use App\Models\Product\Order;
use App\Models\Product\Product;
use App\Models\Admin\Prospect;
use App\Models\Course\Track;

use Illuminate\Support\Facades\Hash;
use App\Mail\usercreate;
use App\Mail\EmailActivation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



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
        
        $objs = $obj->sortable()->where('name','LIKE',"%{$item}%")
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
        $tracks = Track::where('status',1)->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('tests',$tests)
                ->with('products',$products)
                ->with('tracks',$tracks)
                ->with('editor',true)
                ->with('app',$this);
    }

    public function login(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');

        $user = Obj::where('email',$email)->first();

        
        $arr =["error"=>0,"message"=>0];
        if($user){

            if (!Hash::check($password, $user->password))
            {
                $arr =["error"=>1,"message"=>'Password mismatch'];
            }else{
                Auth::login($user);
            }
        }else{
            $arr =["error"=>1,"message"=>'User with email('.$email.') not found'];
        }
        
        echo json_encode($arr);
    }

    public function phone(Request $request){
        $phone = $request->get('phone');

        $user = Prospect::where('phone',$phone)->first();

        $arr =["error"=>0,"message"=>0];
        if($user){
            $arr = $user;
        }else{
            $arr =["error"=>1,"message"=>'User with phone('.$phone.') not found'];
        }
        
        echo json_encode($arr);
    }

    public function register(Obj $obj,Request $request){
        try{

            $arr =["error"=>0,"message"=>0];
            

            if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                $arr["error"] =1;
                $arr["message"] = "Invalid Email ID";
            }

            if (strlen($request->get('phone'))<10) {
                $arr["error"] =1;
                $arr["message"] = "Invalid phone number (less than 10 digits)";
            }

            $phone_exists = $obj->where('phone',$request->get('phone'))->first();
            if ($phone_exists) {
                $arr["error"] =1;
                $arr["message"] = 'User('.$phone_exists->name.') with phone number('.$phone_exists->phone.') already exists in database. Kindly use forgot password option.';
            }

            $email_exists = $obj->where('email',$request->get('email'))->first();
            if ($email_exists) {
                $arr["error"] =1;
                $arr["message"] = 'User('.$email_exists->name.') with email('.$email_exists->email.') already exists in database.Kindly use forgot password option.';
            }

            if(!$arr["error"]){
                $user= $obj->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'status'=>1,
                'idno'=> null,
                'user_id'=>1,
                'activation_token' => mt_rand(10000,99999),
                'sms_token' => mt_rand(1000,9999),
                'password' =>  Hash::make($request->get('password')),
                'auto_password'=> '',
                ]);

                //$u = User::where('email','=',$request->get('email'))->first();
                Auth::login($user);

                $user->resend_sms($user->phone,$user->sms_token);
                Mail::to($user->email)->send(new EmailActivation($user));
            }

            return json_encode($arr);
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

            $email_exists = $obj->where('email',$request->get('email'))->first();
            if ($email_exists) {
                flash('User('.$email_exists->name.') with email('.$email_exists->email.') already exists in database.')->error();
                return redirect()->back()->withInput();;
            }

            $phone_exists = $obj->where('phone',$request->get('phone'))->first();
            if ($phone_exists) {
                flash('User('.$phone_exists->name.') with phone number('.$phone_exists->phone.') already exists in database.')->error();
                return redirect()->back()->withInput();;
            }

            if($request->get('idno')){
               $idno_exists = $obj->where('idno',$request->get('idno'))->first();
                if ($idno_exists) {
                    flash('User('.$idno_exists->name.') with ID number('.$idno_exists->idno.') already exists in database.')->error();
                    return redirect()->back()->withInput();;
                } 
            }
            

            /* create a new entry */
           $user= $obj->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'status'=>$request->get('status'),
            'enrolled'=>$request->get('enrolled'),
            'comment'=>$request->get('comment'),
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

            $tracks = $request->get('tracks');
            if($tracks){
                $user->tracks()->detach();
                foreach($tracks as $t){
                $user->tracks()->attach($t);
                }
            }else{
                $user->tracks()->detach();
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
    public function show($id,Request $request)
    {
        $obj = Obj::where('id',$id)->first();

        if($request->get('resend_email')){
            $obj['password_string'] = $obj->auto_password;
            Mail::to($obj->email)->send(new usercreate($obj));
            flash('Successfully mailed the account details to ('.$obj->email.')')->success();
        }

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
        $tracks = Track::where('status',1)->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('tests',$tests)
                ->with('products',$products)
                ->with('tracks',$tracks)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    public function useredit()
    {
        $obj= \auth::user();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.edit')
                ->with('stub','Update')
                ->with('obj',$obj)
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
            $user = $obj;

            $this->authorize('update', $obj);


            if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                flash('Invalid Email')->error();
                return redirect()->back()->withInput();;
            }

            if (strlen($request->get('phone'))<10) {
                flash('Invalid phone number (less than 10 digits)')->error();
                return redirect()->back()->withInput();;
            }

            $obj2 = Obj::where('email',$request->get('email'))->first();
            if ($obj2) {
                if($obj2->id !=$obj->id){
                    flash('User('.$obj2->name.') with similar details already exists in database.')->error();
                    return redirect()->back()->withInput();
                }
                
            }

            $obj2 = Obj::where('phone',$request->get('phone'))->first();
            if ($obj2) {
                if($obj2->id !=$obj->id){
                    flash('User('.$obj2->name.') with similar details already exists in database.')->error();
                    return redirect()->back()->withInput();
                }
                
            }


            
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

            $tracks = $request->get('tracks');
            if($tracks){
                $user->tracks()->detach();
                foreach($tracks as $t){
                $user->tracks()->attach($t);
                }
            }else{
                $user->tracks()->detach();
            }


            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.show',$id);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 flash('Some error in updating the record')->error();
                 
            }
        }
    }

    public function userstore(Request $request)
    {
        try{
            $obj = Obj::where('id',$request->get('id'))->first();


            if($request->get('password')){
                if($request->get('password') != $request->get('repassword')){
                    return redirect()->back()->withInput();
                }else{
                    $request->merge(['password' => Hash::make($request->get('password'))]);;
                }
            }else{
                unset($request['password']);
            }

             /* If image is given upload and store path */
            if(isset($request->all()['file'])){
                if(Storage::disk('public')->exists('images/'.$obj->id.'.jpg')){
                    Storage::disk('public')->delete('images/'.$obj->id.'.jpg');
                }

                if(Storage::disk('public')->exists('images/'.$obj->id.'.png')){
                    Storage::disk('public')->delete('images/'.$obj->id.'.png');
                }
                $file      = $request->all()['file'];
                $extension = $file->getClientOriginalExtension();
                $filename  = $obj->id.'.' . $extension;
                $path      = $file->storeAs('public/images/', $filename);
            }
            

            $obj->update($request->all()); 

            flash('Your profile is updated!')->success();
            return redirect()->route('home');
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Prospect as Obj;
use App\Models\Admin\Followup;
use App\User;
use Carbon\Carbon;

class ProspectController extends Controller
{
   
   public function __construct(){
        $this->app      =   'admin';
        $this->module   =   'prospect';
    }

    public function dashboard(Obj $obj,Request $r){


        $user_id = $r->get('user_id');
        $range = $r->get('range');


        $counter = $obj->getCount($user_id,$range);  

        if(!$user_id)
            $objs = $obj->getDataDate($obj,$range)
                    ->orderBy('created_at','desc')
                    ->paginate(5); 
        else
            $objs = $obj->getDataDate($obj,$range)->where('user_id',$user_id)->orderBy('created_at','desc')
                    ->paginate(5);   

        $employees = User::whereIn('admin',[1,2])->get();

        if($user_id)
            $employee = User::where('id',$user_id)->first();
        else
            $employee = null;

        $view = 'dashboard';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('counter',$counter)
                ->with('employees',$employees)
                ->with('employ',$employee)
                ->with('app',$this);
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
        $stage = $request->stage;
        $user_id = $request->get('user_id');
        $range = $request->get('range');
        if($range){
            if($stage)
                $model =$obj->getDataDate($obj,$range)->where('stage',$stage);
            else
                $model = $obj->getDataDate($obj,$range);
        }else{
            if($stage)
            $model = $obj->sortable()->where('stage',$stage);
            else
            $model = $obj->sortable();
        }

        if(!$user_id){

            $objs = $model->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            if($item)
            $objs = $model->where('name','LIKE',"%{$item}%")
                    ->orWhere('phone','LIKE',"%{$item}%")
                    ->orWhere('email','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
        }
        else{

            $objs = $model->where('user_id',$user_id)
                ->paginate(config('global.no_of_records'));  

            if($item){
                $objs = $model->where('user_id',$user_id)
                ->where('name','LIKE',"%{$item}%")
                    ->orWhere('phone','LIKE',"%{$item}%")
                    ->orWhere('email','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                ->paginate(config('global.no_of_records')); 
            }   
        }

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
        $employees = User::whereIn('admin',[1,2])->get();
        $followup = new Followup();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('datetimepicker',true)
                ->with('followup',$followup)
                ->with('employees',$employees)
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
            
           
            $arr["error"] = 0;

            if(!$request->get('name')){
                $arr["error"] =1;
                $arr["message"] = "Name cannot be empty";
            }
            if($request->get('email'))
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
                $arr["message"] = 'User('.$phone_exists->name.') with phone number('.$phone_exists->phone.') already exists in database. ';
            }

            if($request->get('email')){
                $email_exists = $obj->where('email',$request->get('email'))->first();
                if ($email_exists) {
                    $arr["error"] =1;
                    $arr["message"] = 'User('.$email_exists->name.') with email('.$email_exists->email.') already exists in database.';
                }
            }else{
                $request->merge(['email'=>' ']);
            }

            if(!$request->get('created_at')){
                $request->merge(['created_at'=>date("Y-m-d H:i:s")]);
            }
            

            if($arr["error"]){
                    flash($arr['message'])->success();
                     return redirect()->back()->withInput();;
            }
            

             /* create a new entry */
            $id = $obj->create($request->all())->id;

            if($request->get('comment') || $request->get('schedule') ){
                $f = new Followup();
                $f->user_id = $request->get('user_id');
                $f->prospect_id = $id;
                $f->comment = ($request->get('comment'))?$request->get('comment'):'- None -';
                $f->schedule = $request->get('schedule');
                $f->save();
            }
            
            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.index');
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                flash('Some error in Creating the record')->error();
                 return redirect()->back()->withInput();;
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
        $employees = User::whereIn('admin',[1,2])->get();
        $followup = Followup::where('prospect_id',$id)->first();

       

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('datetimepicker',true)
                ->with('followup',$followup)
                ->with('employees',$employees)
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

            if(!$request->get('email')){
                $request->merge(['email'=>' ']);
            }

            //dd($request->all());
            $obj->update($request->all()); 

            if($request->get('comment') || $request->get('schedule') ){
                $f = Followup::where('prospect_id',$id)->first();
                if(!$f){
                    $f = new Followup();
                    $f->prospect_id = $id;
                    $f->user_id = $request->get('user_id');
                }
                $f->comment = ($request->get('comment'))?$request->get('comment'):'- None -';
                $f->schedule = $request->get('schedule');
                $f->save();
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

        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

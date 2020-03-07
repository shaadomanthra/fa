<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Followup as Obj;
use App\Models\Admin\Prospect;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FollowupController extends Controller
{

    public function __construct(){
        $this->app      =   'admin';
        $this->module   =   'followup';
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
        $today = $request->today;
        $state = $request->state;

        $user_id = $request->get('user_id');

        if($request->get('view')){

            if($user_id)
            $objs = $obj->sortable()->where('user_id',$user_id)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->sortable()->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 

        }elseif($state==1){
            if($user_id)
            $objs = $obj->sortable()->where('user_id',$user_id)->where('state',1)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->sortable()->where('state',1)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 



        }else if($state===0){
            if($user_id)
            $objs = $obj->sortable()->where('user_id',$user_id)->where('state',0)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->sortable()->where('state',0)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 


        }else if($state==2){
            $now = \Carbon\Carbon::now()->format('Y-m-d');
            if($user_id)
            $objs = $obj->sortable()->where('user_id',$user_id)->where('state',1)->where('schedule','<',$now)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->sortable()->where('state',1)->where('schedule','<',$now)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
        }
        else if($today){
            if($user_id)
                $objs = $obj->sortable()->where('user_id',$user_id)->whereDate('schedule', Carbon::today())
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));  
            else
            $objs = $obj->sortable()->whereDate('schedule', Carbon::today())
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));  
        }else{
            $ids =[];
            $objx = $obj->sortable()->orderBy('created_at','desc')->get()->groupBy('prospect_id');
            foreach($objx as $ob){
                array_push($ids, $ob[0]->id);
            }
            if($user_id)
            $objs = $obj->sortable()->where('user_id',$user_id)->whereIn('id',$ids)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->sortable()->whereIn('id',$ids)->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));  
        }
        
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('today',$today)
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

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('datetimepicker',true)
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
            
            
            $prospect = null;
            if($request->phone)
            {
                $prospect = Prospect::where('phone',$request->phone)->first();
                if($prospect)
                    $prospect = $prospect->id;
            }

            if(!$prospect){
                flash('Prospect with given phone number not found')->success();
                return redirect()->back()->withInput();;
            }

            $obj->user_id = $request->get('user_id');
            $obj->prospect_id = $prospect;
            $obj->comment = $request->get('comment');
            $obj->schedule = $request->get('schedule');
            if($obj->schedule)
                $obj->state = 1;
            else
                $obj->state = 0;

            //dd($obj);
            /* create a new entry */
            $obj->save();

            $id = $obj->orderBy('id','desc')->first()->id;

            $prev  = Obj::where('prospect_id',$prospect)->where('state',1)->orderBy('id','desc')->get();

            //dd($prev);
            foreach($prev as $p){
                if($p->id!=$id){
                    $p->state=0;
                    $p->save();
                }  
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

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
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


            $this->authorize('update', $obj);
            
            

            $obj = $obj->update($request->all()); 


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

<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Client as Obj;
use App\User;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /*
        Coupon Controller
    */

    public function __construct(){
        $this->app      =   'product';
        $this->module   =   'client';
        $this->cache_path =  '../storage/app/cache/clients/';
        $this->image_path =  '../storage/app/public/clients/';
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
        $users = User::whereIn('admin',[5])->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('users',$users)
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
            
            /* create a new entry */
            $obj = $obj->create($request->all());

            /* update in cache folder */
            $domains = explode(',', $request->get('domains'));
            /* update in cache folder */
            foreach($domains as $d){
                $filename = $this->cache_path.$d.'.json'; 
                file_put_contents($filename, json_encode($obj,JSON_PRETTY_PRINT));  
            }

            

            /* If image is given upload and store path */
            if(isset($request->all()['image_'])){
                $file      = $request->all()['image_'];
                $filename = $obj->id.'.'.$file->getClientOriginalExtension();
                $path_ = Storage::disk('public')->putFileAs('clients', $request->file('image_'),$filename);
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
        $users = User::whereIn('admin',[5])->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('users',$users)
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

            $obj->update($request->except(['products'])); 

            $domains = explode(',', $request->get('domains'));
            /* update in cache folder */
            foreach($domains as $d){
                $filename = $this->cache_path.$d.'.json'; 
                file_put_contents($filename, json_encode($obj,JSON_PRETTY_PRINT));  
            }
            
            /* If image is given upload and store path */
            if(isset($request->all()['image_'])){
                $file      = $request->all()['image_'];
                $filename = $obj->id.'.'.$file->getClientOriginalExtension();
                $path_ = Storage::disk('public')->putFileAs('clients', $request->file('image_'),$filename);
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

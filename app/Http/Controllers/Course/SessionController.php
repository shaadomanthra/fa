<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course\Session as Obj;
use App\Models\Course\Track;

class SessionController extends Controller
{
   /*
         Controller
    */

    public function __construct(){
        $this->app      =   'course';
        $this->module   =   'session';
        if(request()->segment(3) && request()->segment(3)!='join'){
            $this->track   =   request()->segment(3);
            $this->track_id = Track::where('slug',$this->track)->first()->id;
        }else{
            $this->track = null;
            $this->track_id = null;
        }
        

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

        $slug = (rand(10000,100000));

        $exists = Obj::where('slug',$slug)->first();
        if($exists)
            $slug = rand(10000,100000);

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('slug',$slug)
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
            
        
            // update slug with name if its empty
            if(!$request->get('slug')){
                $request->merge(['slug' => strtolower(str_replace(' ','_',$request->get('name')))]);
            }
            
            // update slug with name if its empty
            if(!$request->get('meeting_url')){
                $request->merge(['meeting_url' => '0']);
            }
            if(!$request->get('meeting_id')){
                $request->merge(['meeting_id' => '0']);
            }

            if(!$request->get('meeting_password')){
                $request->merge(['meeting_password' => '0']);
            }

            if(!$request->get('faculty')){
                $request->merge(['faculty' => '0']);
            }

            /* create a new entry */
            $obj = $obj->create($request->except(['file']));

            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.show',[$this->track,$obj->slug]);
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
    public function url($id)
    {
        $obj = Obj::where('slug',$id)->first();
        $user = \auth::user();
        $track = $obj->track;

        if(!$track->users->contains($user->id))
        {
            return view('appl.'.$this->app.'.'.$this->module.'.noaccess')
                    ->with('obj',$obj)->with('app',$this);
        }

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.url')
                    ->with('obj',$obj)->with('app',$this);
        else
            abort(404);
    }


    public function join($id)
    {
        $obj = Obj::where('slug',$id)->first();
        $user = \auth::user();
        $track = $obj->track;

        if(!$track->users->contains($user->id))
        {
            return view('appl.'.$this->app.'.'.$this->module.'.noaccess')
                    ->with('obj',$obj)->with('app',$this);
        }

        if(!$obj->users->contains($user->id))
            $obj->users()->attach($user->id);
        

        if($obj->status){
            if($obj->meeting_url)
            return redirect()->to($obj->meeting_url);
            else
            return redirect()->route('session.url',$obj->slug);
        }
        else
            abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($track,$id)
    {
        $obj = Obj::where('slug',$id)->first();
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
    public function edit($track,$id)
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
    public function update(Request $request, $track,$id)
    {
        try{
            $obj = Obj::where('id',$id)->first();

            $this->authorize('update', $obj);
            
            // update slug with name if its empty
            if(!$request->get('meeting_url')){
                $request->merge(['meeting_url' => '0']);
            }
            if(!$request->get('meeting_id')){
                $request->merge(['meeting_id' => '0']);
            }

            if(!$request->get('meeting_password')){
                $request->merge(['meeting_password' => '0']);
            }

            if(!$request->get('faculty')){
                $request->merge(['faculty' => '0']);
            }

            $obj->update($request->except(['file'])); 
            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.show',[$this->track,$obj->slug]);
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

        // remove file
        if(Storage::disk('public')->exists($obj->image))
            Storage::disk('public')->delete($obj->image);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

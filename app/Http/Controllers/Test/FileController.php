<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\File as Obj;
use App\Models\Test\Test ;
use Illuminate\Support\Facades\Storage;
use App\User;

use App\Mail\reviewnotify;
use Illuminate\Support\Facades\Mail;

class FileController extends Controller
{
    /*
        Test Tags Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'file';
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
        
        $objs = $obj->where('response','LIKE',"%{$item}%")
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, Request $request)
    {
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

        if(!$obj)
            abort(404);

        /* get extension and load player */
        $info = pathinfo('uploads/'.$obj->response);
        $ext = $info['extension'];

        if(in_array($ext, ['mp3','wav','mkv'])){
            return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this)->with('player',true);
        }else{
            return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this)->with('player',false);
        }
        
     
            
        
            
    }



    /**
     * Download the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('view', $obj);
        
        if($obj)
            return response()->download('uploads/'.$obj->response);
        else
            abort(404);
    }

    /**
     * Notify User with Email
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notify($id)
    {
        $obj = Obj::where('id',$id)->first();
        $test  = Test::where('id',$obj->test_id)->first();
        $this->authorize('view', $obj);
        $user = User::where('id',$obj->user_id)->first();
        if($obj){

             //Mail notifaction to the user
             Mail::to($user->email)->send(new reviewnotify($user,$test));

            return view('appl.'.$this->app.'.attempt.notify')->with('user',$user);
        }
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
            $obj->answer = $request->answer;
            $obj->save();
            
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

        // remove file
        if(Storage::disk('uploads')->exists($obj->file))
            Storage::disk('uploads')->delete($obj->file);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

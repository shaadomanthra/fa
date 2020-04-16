<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Section as Obj;
use App\Models\Test\Test;

class SectionController extends Controller
{
    /*
        The Section Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'section';
        if(request()->route('test')){
            $this->test = Test::find(request()->route('test'));
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
                    ->where('test_id',$this->test->id)
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

        $this->slug = \str_random(5);

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
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
            
            if(!$request->get('name')){
                flash('Name of section cannot be empty')->error();
                 return redirect()->back()->withInput();;
            }
            // update slug with name if its empty
            if(!$request->get('slug')){
                $request->merge(['slug' => strtolower(str_replace(' ','_',$request->get('name')))]);
            }

            /* If image is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $extension = $file->getClientOriginalExtension();
                $filename  = str_random().'.' . $extension;

                $path      = $file->storeAs('public/files/extract/', $filename);
 
                $request->merge(['file' => 'files/extract/'.$filename]);
            }

            $user = \auth::user();
            if($request->get('instructions')){
                $request->merge(['instructions' => summernote_imageupload($user,$request->get('instructions'))]);
            }

            
            /* create a new entry */
            $obj = $obj->create($request->all());


            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.show',[$this->test->id,$obj->id]);
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
    public function show($test_id,$id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('view', $obj);
        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this)->with('player',true);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($test_id,$id)
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
    public function update(Request $request, $test_id,$id)
    {
        try{
            $obj = Obj::where('id',$id)->first();

            $this->authorize('update', $obj);

            /* delete file request */
            if($request->get('deletefile')){
                if(file_exists(storage_path('app/public/'.$obj->file)))
                    unlink(storage_path('app/public/'.$obj->file));
                redirect()->route($this->module.'.show',[$test_id,$id]);
            }

            /* If file is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $extension = $file->getClientOriginalExtension();
                if($obj->filename){
                    $filename = str_replace('files/extract/', '', $obj->file);
                }else{
                    $filename  = str_random().'.' . $extension;
                }
                
                $path      = $file->storeAs('public/files/extract/', $filename);
 
                $request->merge(['file' => 'files/extract/'.$filename]);

                //echo $filename."<br>";
            }

            $user = \auth::user();
            if($request->get('instructions')){
                $request->merge(['instructions' => summernote_imageupload($user,$request->get('instructions'))]);

                if(!strip_tags(trim($request->get('instructions'))))
                    $request->merge(['instructions' => '']);
            }

            $obj = $obj->update($request->except(['tags'])); 
            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.show',[$test_id,$id]);
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
    public function destroy($test_id,$id)
    {
        $obj = Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index',$this->test->id);
    }
}

<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Extract as Obj;
use App\Models\Test\Test;
use App\Models\Test\Section;

class ExtractController extends Controller
{
     /*
        The Extract Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'extract';
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

        if($request->get('addp')){


        for($id=179;$id<187;$id++){
            $t = Test::where('id',$id)->first();
            if(!$t)
                dd();

            $p = $obj->where('name','Instructions')->first();


            $f = $t->fillup_q1();
            $m = $t->mcq_q1();
            if($m){
                $m->extract_id = $p->id;
                $m->save();
            }
        }

        }

        $search = $request->search;
        $item = $request->item;
        
        if($item)
        $objs = $obj->where('test_id',$this->test->id)
                    ->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));
        else   
        $objs = $obj->where('test_id',$this->test->id)
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

        $sections = Section::where('test_id',$this->test->id)->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('sections',$sections)
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
            
            /* If image is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $extension = $file->getClientOriginalExtension();
                $filename  = str_random().'.' . $extension;
                $path      = $file->storeAs('public/files/extract/', $filename);
 
                $request->merge(['file' => 'files/extract/'.$filename]);
            }

            $user = \auth::user();
            /* upload images if any */
            $text = summernote_imageupload($user,$request->get('text'));

            if($request->get('layout')=='gre_selection'){
                    $pieces = explode('.',strip_tags($text));
                    
                    $str ='';
                    foreach($pieces as $p){
                        if($p!="\n" && $p!="\r" && $p!="\r\n" && $p!="\n\r" && $p)

                        $str = $str.'<span class="sentence sentence_'.$obj->id.'" data-id="'.$obj->id.'">'.$p.'.</span>';
                    }
                    $text = $str;
            }


            
            /* merge the updated data in request */
            $request->merge(['text' => $text]);

            if(!$request->get('glance_time'))
                $request->merge(['glance_time' => 0]);
            
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
        $sections = Section::where('test_id',$this->test->id)->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('sections',$sections)
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
                $filename = str_replace('files/extract/', '', $obj->file);
                $path      = $file->storeAs('public/files/extract/', $filename);
 
                $request->merge(['file' => 'files/extract/'.$filename]);

                //echo $filename."<br>";
            }

            if($request->get('text')){
                $user = \auth::user();
                /* upload images if any */
                $text = summernote_imageupload($user,$request->get('text'));
                

                if($request->get('layout')=='gre_selection'){
                    $pieces = explode('.',strip_tags($text));
                    
                    $str ='';
                    foreach($pieces as $p){
                        if($p!="\n" && $p!="\r" && $p!="\r\n" && $p!="\n\r" && $p)

                        $str = $str.'<span class="sentence sentence_'.$obj->id.'" data-id="'.$obj->id.'">'.$p.'.</span>';
                    }
                    $text = $str;
                
                }


                /* merge the updated data in request */
                $request->merge(['text' => $text]);
            }

            $obj = $obj->update($request->all());
            

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

        

        /* remove images before deleting */
        summernote_imageremove($obj->text);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index',$this->test->id);
    }
}

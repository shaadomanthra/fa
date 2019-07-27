<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Group as Obj;
use Illuminate\Support\Facades\Storage;
use App\Models\Test\Test;

class GroupController extends Controller
{
    /*
        Test Groups Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'group';
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

        $tests = Test::where('status',1)->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('tests',$tests)
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
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('uploads')->putFile($this->module, $request->file('file'));
 
                $request->merge(['image' => $path]);
            }


            // update slug with name if its empty
            if(!$request->get('slug')){
                $request->merge(['slug' => strtolower(str_replace(' ','_',$request->get('name')))]);
            }
            
            /* create a new entry */
            $obj = $obj->create($request->except(['file','tests']));

            // attach the tags
            $tests = $request->get('tests');
            foreach($tests as $test){
                $obj->tests()->attach($test);
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
        $tests = Test::where('status',1)->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('tests',$tests)
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

            if($request->get('deleteimage')){
               if(Storage::disk('uploads')->exists($obj->file))
                    Storage::disk('uploads')->delete($obj->file);
                redirect()->route($this->module.'.show',[$id]);
            }

            $this->authorize('update', $obj);
            /* If image is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('uploads')->putFile($this->module, $request->file('file'));
 
                $request->merge(['image' => $path]);
            }

            // attach the tags
            $tests = $request->get('tests');
            if($tests){
                $obj->tests()->detach();
                foreach($tests as $test){
                $obj->tests()->attach($test);
                }
            }else{
            	$obj->tests()->detach();
            }

            $obj = $obj->update($request->except(['file','tests'])); 



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
        if(Storage::disk('uploads')->delete($obj->image)){
            Storage::disk('uploads')->delete($obj->image);
        }

        $obj->tests()->detach();
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

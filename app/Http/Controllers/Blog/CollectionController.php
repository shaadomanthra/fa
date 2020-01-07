<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Collection as Obj;
use App\User;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
     public function __construct(){
        $this->app      =   'blog';
        $this->module   =   'collection';
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
                    ->orWhere('slug','LIKE',"%{$item}%")
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
            
           
            $arr["error"] = 0;
            

            if (!$request->get('name')) {
                $arr["error"] =1;
                $arr["message"] = "Name cannot be empty";
            }

            if(!$request->get('slug')){
                $request->merge(['slug' => strtolower(str_replace(' ','-',$request->get('name')))]);
            }

            $collection_exists = $obj->where('slug',$request->get('slug'))->first();
            if ($collection_exists) {
                $arr["error"] =1;
                $arr["message"] = 'Category ('.$collection_exists->slug.') slug already exists in database. ';
            }

            /* If image is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('public')->putFile('images', $request->file('file'));
                $request->merge(['image' => $path]);
            }
            

            if($arr["error"]){
                    flash($arr['message'])->success();
                     return redirect()->back()->withInput();;
            }
            

             /* create a new entry */
            $id = $obj->create($request->all())->id;

            
            flash('A new category ('.$request->get('slug').') item is created!')->success();
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
    public function show($slug)
    {
        $obj = Obj::where('slug',$slug)->first();
   
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

            /* delete file request */
            if($request->get('deletefile')){
                if(Storage::disk('public')->exists($obj->image)){
                    Storage::disk('public')->delete($obj->image);
                }
                redirect()->route($this->module.'.show',[$obj->slug]);
            }

            /* If file is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('public')->putFile('images', $request->file('file'));
                $request->merge(['image' => $path]);
            }

            $obj->update($request->all()); 

            

            flash('('.$obj->slug.') category item is updated!')->success();
            return redirect()->route($this->module.'.show',$obj->slug);
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

        flash('('.$obj->slug.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

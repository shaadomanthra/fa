<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Page as Obj;
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
     /*
        Test Tags Controller
    */

    public function __construct(){
        $this->app      =   'admin';
        $this->module   =   'page';
        $this->cache_path =  '../storage/app/cache/pages/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {
        
        $search = $request->search;
        $item = $request->item;
        $objs = $obj->where('content','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
         /* update in cache folder */
        if($request->refresh){
            foreach($objs as $obj){ 
                $filename = $obj->slug.'.json';
                $filepath = $this->cache_path.$filename;

                file_put_contents($filepath, json_encode($obj,JSON_PRETTY_PRINT));
            }
            flash('Pages Cache Updated')->success();
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
            
            /* create a new entry */
            $obj = $obj->create($request->all());

            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.view',$obj->slug);
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
        $filename = $slug.'.json';
        $filepath = $this->cache_path.$filename;

        if(Storage::disk('cache')->exists('pages/'.$filename))
        {
            $obj = json_decode(file_get_contents($filepath));
        }else
            $obj = Obj::where('slug',$slug)->first();

        if($obj){
            if(\auth::user())
                if(\auth::user()->admin==1)
                    return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this);
                else{
                    if($obj->status==1)
                      return view('appl.'.$this->app.'.'.$this->module.'.show')
                        ->with('obj',$obj)->with('app',$this);
                    else
                      abort(404);
                }
            else{
                if($obj->status==1)
                      return view('appl.'.$this->app.'.'.$this->module.'.show')
                        ->with('obj',$obj)->with('app',$this);
                    else
                      abort(404);
            }

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
    public function edit($slug)
    {
        $obj= Obj::where('slug',$slug)->first();
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
    public function update(Request $request, $slug)
    {
        try{
            $obj = Obj::where('slug',$slug)->first();

            $this->authorize('update', $obj);
            
        
            
            $obj->update($request->all()); 
            $filename = $slug.'.json';
            $filepath = $this->cache_path.$filename;
            file_put_contents($filepath, json_encode($obj,JSON_PRETTY_PRINT));

            flash('('.$this->app.'/'.$this->module.') item is updated!')->success();
            return redirect()->route($this->module.'.view',$slug);
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
    public function destroy($slug)
    {
        $obj = Obj::where('slug',$slug)->first();
        $this->authorize('update', $obj);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

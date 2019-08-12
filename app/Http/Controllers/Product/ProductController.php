<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Product as Obj;
use App\Models\Test\Group;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
        Product Controller
    */

    public function __construct(){
        $this->app      =   'product';
        $this->module   =   'product';
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

        if(request()->getHost()=='project.test')
            $folder = 'cache';
        else
            $folder = 'cache';

        /* update in cache folder */
        if($request->refresh){
            $filename = '../'.$folder.'/index.'.$this->app.'.'.$this->module.'.json';
            $objs = $obj->orderBy('created_at','desc')
                        ->get();  
            file_put_contents($filename, json_encode($objs,JSON_PRETTY_PRINT));
            
            foreach($objs as $obj){ 
                $filename = '../cache/product/'.$obj->slug.'.json';
                $obj->groups = $obj->groups;
                foreach($obj->groups as $m=>$group){
                    $obj->groups->tests = $group->tests;
                    foreach($obj->groups->tests as $test){
                        $obj->groups->tests->testtype = $test->testtype;
                    }
                }
                file_put_contents($filename, json_encode($obj,JSON_PRETTY_PRINT));
            }
           
            flash('Product Pages Cache Updated')->success();
        }
            
        $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));  
        
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('app',$this);
    }


    /** PUBLIC LISTING
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public(Obj $obj,Request $request)
    {

        $search = $request->search;
        $item = $request->item;
        
        if(request()->getHost()=='project.test')
            $folder = 'cache';
        else
            $folder = 'cache';

        $filename = '../'.$folder.'/index.'.$this->app.'.'.$this->module.'.json';
        if(file_exists($filename) && !$search)
        {
            $objs = json_decode(file_get_contents($filename));
        }else{
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->get();  
            file_put_contents($filename, json_encode($objs,JSON_PRETTY_PRINT));
        }

        $view = $search ? 'public_list': 'public';

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

        $groups  = Group::where('status',1)->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('groups',$groups)
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

            /* If image is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('uploads')->putFile('product', $request->file('file'));
                $request->merge(['image' => $path]);
            }

            /* create a new entry */
            $obj->create($request->except(['groups','file']));

            // attach the tags
            $groups = $request->get('groups');
            if($groups)
            foreach($groups as $group){
                $obj->groups()->attach($group);
            }

            if(request()->getHost()=='project.test')
            $folder = 'cache';
            else
            $folder = 'cache';

            /* update in cache folder */
            $filename = '../'.$folder.'/index.'.$this->app.'.'.$this->module.'.json';
            $objs = $obj->orderBy('created_at','desc')
                        ->get(); 
            file_put_contents($filename, json_encode($objs,JSON_PRETTY_PRINT));
            

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


    /** PUBLIC LISTING
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($slug)
    {
        //$obj = Obj::where('slug',$slug)->first();
        if(request()->getHost()=='project.test')
            $folder = 'cache';
        else
            $folder = 'cache';

        $filename = '../'.$folder.'/product/'.$slug.'.json';
        if(file_exists($filename))
        {
            $obj = json_decode(file_get_contents($filename));
        }else{
            $obj = Obj::where('slug',$slug)->first();  
            $obj->groups = $obj->groups;
            foreach($obj->groups as $m=>$group){
                $obj->groups->tests = $group->tests;
                foreach($obj->groups->tests as $test){
                    $obj->groups->tests->testtype = $test->testtype;
                }
            }
            file_put_contents($filename, json_encode($obj,JSON_PRETTY_PRINT));
        }

        if(\auth::user())
            $obj->order = \auth::user()->orders()->where('product_id',$obj->id)->where('status',1)->orderBy('id','desc')->first();
        else
            $obj->order = null;

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.view')
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
        $groups  = Group::where('status',1)->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('groups',$groups)
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


            // change to uppercase
            if($request->get('name')){
                $request->merge(['name' => strtoupper($request->get('name'))]);
            }

             /* delete file request */
            if($request->get('deletefile')){

                if(Storage::disk('uploads')->exists($obj->image)){
                    Storage::disk('uploads')->delete($obj->image);
                }
                redirect()->route($this->module.'.show',[$id]);
            }

            $this->authorize('update', $obj);
            /* If file is given upload and store path */
            if(isset($request->all()['file'])){
                $file      = $request->all()['file'];
                $path = Storage::disk('uploads')->putFile('product', $request->file('file'));
                $request->merge(['image' => $path]);
            }

            
            // attach the tags
            $groups = $request->get('groups');
            if($groups){
                $obj->groups()->detach();
                foreach($groups as $group){
                $obj->groups()->attach($group);
                }
            }else{
            	$obj->groups()->detach();
            }

            $obj->update($request->except(['groups','file'])); 

            if(request()->getHost()=='project.test')
            $folder = 'cache';
            else
            $folder = 'cache';

            /* update in cache folder */
            $filename = '../'.$folder.'/index.'.$this->app.'.'.$this->module.'.json';
            $objs = $obj->orderBy('created_at','desc')
                        ->get();  
            file_put_contents($filename, json_encode($objs,JSON_PRETTY_PRINT));
            

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
        if(Storage::disk('uploads')->exists($obj->image))
            Storage::disk('uploads')->delete($obj->image);

        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

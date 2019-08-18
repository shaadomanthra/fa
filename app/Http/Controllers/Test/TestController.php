<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Test as Obj;
use App\Models\Test\Tag;
use App\Models\Test\Type;
use App\Models\Test\Category;
use App\Models\Test\Group;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    /*
        The Core Test Application Controller
    */

    public function __construct(){
        $this->app      =   'test';
        $this->module   =   'test';
        $this->cache_path =  '../storage/app/cache/test/';
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

        $types = Type::all();
        $categories = Category::where('status',1)->get();
        $groups = Group::where('status',1)->orderBy('id','desc')->get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('types',$types)
                ->with('categories',$categories)
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

            /* If file is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $path = Storage::disk('public')->putFile('extracts', $request->file('file_'));
                $request->merge(['file' => $path]);
            }

            $user = \auth::user();
            /* upload images if any */
            $text = summernote_imageupload($user,$request->get('description'));
            
            /* merge the updated data in request */
            $request->merge(['description' => $text]);

            /* create a new entry */
            $obj = $obj->create($request->all());

            flash('A new ('.$this->app.'/'.$this->module.') item is created!')->success();
            return redirect()->route($this->module.'.index');
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                flash('Some error in Creating the record')->error();
                 return redirect()->back()->withInput();
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

        $filename = $this->cache_path.$this->app.'.'.$obj->slug.'.json'; 
        if(file_exists($filename)){
            $json = json_decode(file_get_contents($filename)); 
            $obj->cache_updated_at = $json->updated_at;
        }

        $app = $this;
        $app->test= $obj;
        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$app)->with('player',true);
        else
            abort(404);
    }

    
    public function cache($id)
    {
        $obj= Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        /* update in cache folder */
        $filename = $this->cache_path.$this->app.'.'.$obj->slug.'.json'; 

        if(file_exists($filename))
            flash('cache is updated!')->success();
        else
            flash('cache is created!')->success();

        $test = Obj::where('id',$id)->first();
        $test->updated_at = \Carbon\Carbon::now();
        $test->sections = $obj->sections;
        $test->testtype = $obj->testtype;
        $test->category = $obj->category;

        $qcount =0;
        foreach($obj->sections as $section){ 
            $ids = $section->id ;
            $obj->sections->$ids = $section->extracts;
            foreach($obj->sections->$ids as $m=>$extract){
                $obj->sections->$ids->mcq =$extract->mcq_order;
                $obj->sections->$ids->fillup=$extract->fillup_order;
                foreach($extract->mcq as $q){
                    if($q->qno)
                        if($q->qno!=-1)
                        $qcount++;

                }
                foreach($extract->fillup as $q){
                    if($q->qno)
                        if($q->qno!=-1)
                        $qcount++;
                }
            }
                
        }
        $test->qcount = $qcount;

 
        file_put_contents($filename, json_encode($test,JSON_PRETTY_PRINT));
        
        return redirect()->route($this->module.'.show',$id);
    }

    public function cache_delete($id)
    {
        $obj= Obj::where('id',$id)->first();
        $this->authorize('update', $obj);

        /* delete cache */
        $filename = $this->cache_path.$this->app.'.'.$obj->slug.'.json'; 

        if(file_exists($filename)){
            unlink($filename);
            flash('cache delete!')->error();
        }
        else{
            flash('cache file not found!')->error();
        }

        return redirect()->route($this->module.'.show',$id);
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

        $types = Type::all();
        $categories = Category::where('status',1)->get();
        $groups = Group::where('status',1)->orderBy('id','desc')->get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('types',$types)
                ->with('categories',$categories)
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

            $this->authorize('update', $obj);

            /* delete file request */
            if($request->get('deletefile')){
                if(Storage::disk('public')->exists($obj->file))
                    Storage::disk('public')->delete($obj->file);
                redirect()->route($this->module.'.show',[$id]);
            }

            /* If file is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $path = Storage::disk('public')->putFile('extracts', $request->file('file_'));
                $request->merge(['file' => $path]);
            }

            if($request->get('description')){
                $user = \auth::user();
                /* upload images if any */
                $text = summernote_imageupload($user,$request->get('description'));
                
                /* merge the updated data in request */
                $request->merge(['description' => $text]);
            }

            
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

        // remove file
        if(Storage::disk('public')->exists($obj->file))
            Storage::disk('public')->delete($obj->file);
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

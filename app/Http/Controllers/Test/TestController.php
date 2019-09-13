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

     /* The public view page for test */
   public function details($slug,Request $request){
        $obj = Obj::where('slug',$slug)->first();

        if(!$obj)
            abort('404');
        
        return view('appl.test.test.details')
                ->with('test',$obj)
                ->with('obj',$obj);

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

        if($request->get('refresh')){
            foreach($objs as $obj)
                $this->cache_refresh($obj->id);
            flash('cache is updated!')->success();
        }
        
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('app',$this);
    }


    public function public(Obj $obj,Request $request)
    {

        $search = $request->search;
        $item = $request->item;
        $category = $request->category;
        $type = $request->type;
        $category_id = null;
        if($category)
        {
            $cate = Category::where('slug',$category)->first();
            $category_id = $cate->id;
            if($type=='free')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->where('price',0)
                    ->orderBy('created_at','desc')
                    ->paginate(18);
            else if($type=='premium')
             $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->where('price','!=',0)
                    ->orderBy('created_at','desc')
                    ->paginate(18);  
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->orderBy('created_at','desc')
                    ->paginate(18);   
        }else{
            if($type=='free')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price',0)
                    ->orderBy('created_at','desc')
                    ->paginate(18); 
            else if($type=='premium')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price','!=',0)
                    ->orderBy('created_at','desc')
                    ->paginate(18); 
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(18); 
        }

        
        $categories = Category::where('status',1)->get();
        
        $view = $search ? 'public_list': 'public_index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('categories',$categories)
                ->with('app',$this);
    }

    public function cache_refresh($id){
        $obj= Obj::where('id',$id)->first();
        /* update in cache folder */
        $filename = $this->cache_path.$this->app.'.'.$obj->slug.'.json'; 

        $test = Obj::where('id',$id)->first();
        $test->updated_at = \Carbon\Carbon::now();
        $test->sections = $obj->sections;

        $test->mcq_order = $obj->mcq_order;
        $test->fillup_order = $obj->fillup_order;
        $test->testtype = $obj->testtype;
        $test->category = $obj->category;


        $test->qcount =0;
        foreach($obj->sections as $i=>$section){ 
            $ids = $section->id ;
            $obj->sections[$i]->mcq_order =$section->mcq_order;
            $obj->sections[$i]->fillup_order =$section->fillup_order;
            $obj->sections->$ids = $section->extracts;
            foreach($obj->sections->$ids as $m=>$extract){
                $obj->sections->$ids->mcq =$extract->mcq_order;
                $obj->sections->$ids->fillup=$extract->fillup_order;
            }
                
        }

        foreach($test->mcq_order as $q){
            if($q->qno)
              if($q->qno!=-1)
                  $test->qcount++;
          }
          foreach($test->fillup_order as $q){
            if($q->qno)
              if($q->qno!=-1)
                  $test->qcount++;
          }


 
        file_put_contents($filename, json_encode($test,JSON_PRETTY_PRINT));
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
                $request->merge(['slug' => strtolower(str_replace(' ','-',$request->get('name')))]);
            }

            $test = Obj::where('slug',$request->get('slug'))->first();

            if($test){
                flash('Test slug duplication - change slug')->error();
                 return redirect()->back()->withInput();
            }

            /* If file is given upload and store path */
            if(isset($request->all()['file_'])){
                $file      = $request->all()['file_'];
                $path = Storage::disk('public')->putFile('extracts', $request->file('file_'));
                $request->merge(['file' => $path]);
            }

           


            /* If image is given upload and store path */
            if(isset($request->all()['image_'])){
                $file      = $request->all()['image_'];
                $filename = $request->get('slug').'.'.$file->getClientOriginalExtension();
                $path_ = Storage::disk('public')->putFileAs($this->module, $request->file('image_'),$filename);
                $request->merge(['image' => $path_]);
            }

            $sizes = [300,600,900,1200];
            if(isset($path_))
            foreach($sizes as $s)
                image_resize($path_,$s);

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

        $test->mcq_order = $obj->mcq_order;
        $test->fillup_order = $obj->fillup_order;

        foreach($obj->mcq_order as $e => $f){
            if($f->extract)
                $obj->mcq_order[$e]->extract = $f->extract;
        }
        foreach($obj->fillup_order as $e => $f){
            if($f->extract)
                $obj->fillup_order[$e]->extract = $f->extract;
        }

        $test->testtype = $obj->testtype;
        $test->category = $obj->category;

        $test->qcount =0;
        foreach($obj->sections as $i=>$section){ 
            $ids = $section->id ;
            $obj->sections[$i]->mcq_order =$section->mcq_order;
            $obj->sections[$i]->fillup_order =$section->fillup_order;

            foreach($obj->sections[$i]->mcq_order as $e => $f){
                if($f->extract)
                    $obj->sections[$i]->mcq_order[$e]->extract = $f->extract;
            }
            foreach($obj->sections[$i]->fillup_order as $e => $f){
                if($f->extract)
                    $obj->sections[$i]->fillup_order[$e]->extract = $f->extract;
            }

            $obj->sections->$ids = $section->extracts;
            foreach($obj->sections->$ids as $m=>$extract){
                $obj->sections->$ids->mcq =$extract->mcq_order;
                $obj->sections->$ids->fillup=$extract->fillup_order;
            }
                
        }

        foreach($test->mcq_order as $q){
            if($q->qno)
              if($q->qno!=-1)
                  $test->qcount++;
        }
        foreach($test->fillup_order as $q){
            if($q->qno)
              if($q->qno!=-1)
                  $test->qcount++;
        }
 
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

             /* delete image request */
            if($request->get('deleteimage')){
                if(Storage::disk('public')->exists($obj->image))
                    Storage::disk('public')->delete($obj->image);
                redirect()->route($this->module.'.show',[$id]);
            }

            /* If image is given upload and store path */
            if(isset($request->all()['image_'])){

                $file      = $request->all()['image_'];

                $filename = $request->get('slug').'.'.$file->getClientOriginalExtension();
                $path_ = Storage::disk('public')->putFileAs($this->module, $request->file('image_'),$filename);
                $request->merge(['image' => $path_]);

            }

            $sizes = [300,600,900,1200];
             if(isset($path_))
            foreach($sizes as $s)
                image_resize($path_,$s);

            if($request->get('description')){
                $user = \auth::user();
                /* upload images if any */
                $text = summernote_imageupload($user,$request->get('description'));
                
                /* merge the updated data in request */
                $request->merge(['description' => $text]);
            }

            if(isset($request->all()['file_'])){
            $obj = $obj->update($request->all()); 
            }else{
              $obj = $obj->update($request->except(['file']));  
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

        // remove file
        if(Storage::disk('public')->exists($obj->file))
            Storage::disk('public')->delete($obj->file);

        // remove image
        if(Storage::disk('public')->delete($obj->image)){
            Storage::disk('public')->delete($obj->image);
        }
        
        $obj->delete();

        flash('('.$this->app.'/'.$this->module.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Blog as Obj;
use App\Models\Blog\Label;
use App\Models\Blog\Collection;
use App\User;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
     public function __construct(){
        $this->app      =   'blog';
        $this->module   =   'blog';
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
        
        $objs = $obj->where('title','LIKE',"%{$item}%")
                    ->orWhere('slug','LIKE',"%{$item}%")
                    ->orWhere('body','LIKE',"%{$item}%")
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
        $employees = User::whereIn('admin',[1,2])->get();
        $labels = Label::get();
        $collections = Collection::get();

        return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('datetimepicker',true)
                ->with('labels',$labels)
                ->with('collections',$collections)
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
            

            if (!$request->get('title')) {
                $arr["error"] =1;
                $arr["message"] = "Title cannot be empty";
            }

            if(!$request->get('slug')){
                $request->merge(['slug' => strtolower(str_replace(' ','-',$request->get('name')))]);
            }

            $blog_exists = $obj->where('slug',$request->get('slug'))->first();
            if ($blog_exists) {
                $arr["error"] =1;
                $arr["message"] = 'Blog('.$blog_exists->slug.') slug already exists in database. ';
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
            
            $categories = $request->get('category');
            $tags = $request->get('tag');

             /* create a new entry */
            $id = $obj->create($request->all())->id;


            // create tags
            if($tags)
            foreach($tags as $tag){
                if(!$obj->labels->contains($tag))
                    $obj->labels()->attach($tag);
            }

            //create categories
            if($categories)
            foreach($categories as $category){
                if(!$obj->categories->contains($category))
                    $obj->categories()->attach($category);
            }

            
            flash('A new blog ('.$request->get('slug').') item is created!')->success();
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
        $employees = User::whereIn('admin',[1,2])->get();

        $labels = Label::get();
        $collections = Collection::get();

        if($obj)
            return view('appl.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('editor',true)
                ->with('datetimepicker',true)
                ->with('labels',$labels)
                ->with('collections',$collections)
                ->with('employees',$employees)
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

            $categories = $request->get('category');
            $tags = $request->get('tag');

            $category_list =  Collection::orderBy('created_at','desc')
                        ->get()->pluck('id')->toArray();
            //update tags
            if($categories){
                foreach($category_list as $category){
                    if(in_array($category, $categories)){
                        if(!$obj->categories->contains($category))
                            $obj->categories()->attach($category);
                    }else{
                        if($obj->categories->contains($category))
                            $obj->categories()->detach($category);
                    }
                } 
            }else{
                $obj->categories()->detach();
            } 

            $tag_list =  Label::orderBy('created_at','desc')
                        ->get()->pluck('id')->toArray();
            //update tags
            if($tags){
                foreach($tag_list as $tag){
                if(in_array($tag, $tags)){
                    if(!$obj->labels->contains($tag))
                        $obj->labels()->attach($tag);
                }else{
                    if($obj->labels->contains($tag))
                        $obj->labels()->detach($tag);
                }
                
                }
            }else{
                $obj->labels()->detach();
            } 
            

            flash('('.$obj->slug.') blog item is updated!')->success();
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
        $obj->labels()->detach();
        $obj->collections()->detach();

        $obj->delete();

        flash('('.$obj->slug.') item  Successfully deleted!')->success();
        return redirect()->route($this->module.'.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test\Test;
use App\Models\Test\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $view = 'welcome3';
        $tests = Test::where('status',1)->orderBy('id','desc')->limit(18)->get();
        return view($view)
                ->with('tests',$tests);
    }

     public function welcome(Request $request)
    {
        $view = 'welcome4';
        $this->app = 'test';
        $this->module = 'test';

        $obj = new Test();
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
                    ->paginate(config('global.no_of_records')); 
            else if($type=='premium')
             $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->where('price','!=',0)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));    
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));   
        }else{
            if($type=='free')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price',0)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else if($type=='premium')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price','!=',0)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
        }

        
        $categories = Category::where('status',1)->get();
        
        $view = $search ? 'appl.test.test.public_list': 'welcome4';

       
        return view($view)
                ->with('tests',$objs)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('categories',$categories)
                ->with('app',$this);
    }
}

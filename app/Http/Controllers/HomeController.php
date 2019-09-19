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
                    ->where('status',1)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else if($type=='premium')
             $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->where('price','!=',0)
                    ->where('status',1)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));    
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('category_id',$category_id)
                    ->where('status',1)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records'));   
        }else{
            if($type=='free')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price',0)
                    ->where('status',1)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else if($type=='premium')
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('price','!=',0)
                    ->where('status',1)
                    ->orderBy('created_at','desc')
                    ->paginate(config('global.no_of_records')); 
            else
            $objs = $obj->where('name','LIKE',"%{$item}%")
                    ->where('status',1)
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

    public function dashboard(Request $request){
        $orders = \auth::user()->orders()->where('status',1)->get();

        $test_ids = array();
        $tests=array();

        $i=0;
        foreach($orders as $o){

            if($o->test_id){
                if(!in_array($o->test_id, $test_ids)){
                    $o->test->expiry = $o->expiry;
                    $tests[$i] = $o->test;
                            $i++;
                    array_push($test_ids, $o->test_id);
                }
            }
            
            if($o->product_id){
                if(strtotime($o->expiry) > strtotime(date('Y-m-d')))
                {
                    foreach($o->product->tests as $t){
                        if(!in_array($t->id, $test_ids)){
                            $t->expiry = $o->expiry;
                            $tests[$i] = $t;
                            $i++;
                            array_push($test_ids, $t->id);
                        }
                        
                    }
                }

            }    
        }
        return view('appl.pages.dashboard')
                ->with('tests',$tests);
    }
}

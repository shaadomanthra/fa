<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test\Test;
use App\Models\Test\Category;
use App\Models\Test\Attempt;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Gre\Grequestion;
use App\Models\Gre\Grecategory;
use App\Models\Gre\Grepassage;

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
        $view = 'welcome2';
        $tests = Test::where('status',1)->orderBy('id','desc')->limit(18)->get();
        return view($view)
                ->with('tests',$tests);
    }

    public function gre(){
        if(request()->get('n')){
            $c = Grecategory::where('id',request()->get('n'))->first();
        $q =  Grequestion::where('grecategory_id',request()->get('n')-1)->get();
        }else{
            $c = Grecategory::first();
            $q =  Grequestion::where('grecategory_id',$c->id)->get();
        }

        return view('appl.pages.gre')->with('try',1)->with('ques',$q)->with('category',$c);
    }

    public function welcome2()
    {
        $view = 'welcome2';
        
        return view($view);
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
                ->with('toast',1)
                ->with('categories',$categories)
                ->with('app',$this);
    }

    public function dashboard(Request $request){

        
        $orders = \auth::user()->orders()->where('status',1)->orderBy('expiry','desc')->get();

        $test_ids = array();
        $product_ids = array();
        $tests=array();
        $status =array();
        $product_status =array();
        $product_expiry = array();
        $expiry = array();
        $search = $request->search;
        $item = $request->item;
        $item2 = $request->item2;

        $i=0;

        foreach($orders as $o){
          if(strtotime($o->expiry) > strtotime(date('Y-m-d'))){
            if($o->test_id){
                if(!in_array($o->test_id, $test_ids)){
                     array_push($test_ids, $o->test_id);
                }
                $expiry[$o->test_id] = $o->expiry;
                if(strtotime($o->expiry) > strtotime(date('Y-m-d')))
                    $status[$o->test_id] = 'Active';
                else
                    $status[$o->test_id] = 'Expired';
            }
            
            if($o->product_id){
                array_push($product_ids, $o->product_id);
                if(strtotime($o->expiry) > strtotime(date('Y-m-d')))
                    $product_status[$o->product_id] = 'Active';
                else
                    $product_status[$o->product_id] = 'Expired';
                $product_expiry[$o->product_id] = $o->expiry;
                foreach($o->product->tests as $t){
                    if(!in_array($t->id, $test_ids)){
                        array_push($test_ids, $t->id);
                    }
                    $expiry[$t->id] = $o->expiry;
                    if(strtotime($o->expiry) > strtotime(date('Y-m-d')))
                        $status[$t->id] = 'Active';
                    else
                        $status[$t->id] = 'Expired';
                }
            }    
        }
        }

        $tests = Test::whereIn('id',$test_ids)->where('name','LIKE',"%{$item}%")->orderBy('name')->get();
        $products = Product::whereIn('id',$product_ids)->where('name','LIKE',"%{$item2}%")->orderBy('name')->get();

        
        $attempts = Attempt::where('user_id',\auth::user()->id)->whereIn('test_id',$test_ids)->get()->pluck('test_id')->toArray();
        
        foreach($tests as $k=>$t){
            if(in_array($t->id, $attempts))
                $status[$t->id] = 'Completed';
        }

       if($search){
            if($item2)
            $view = 'appl.pages.blocks.productlist';
           else   
            $view = 'appl.pages.blocks.testlist';
       }
       else
        $view = 'appl.pages.dashboard2';

        return view($view)
                ->with('tests',$tests)
                ->with('products',$products)
                ->with('expiry',$expiry)
                ->with('product_expiry',$product_expiry)
                ->with('product_status',$product_status)
                ->with('status',$status);
    }
}

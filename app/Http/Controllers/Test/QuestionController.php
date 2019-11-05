<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Fillup;
use App\Models\Test\Mcq;
use App\Models\Test\Extract;
use App\Models\Test\Section;
use App\Models\Test\Tag;
use App\Models\Test\Test;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->search;
        $item = $request->item;
        
        $objs = $obj->where('test_id',$this->test->id)->where(function ($query) use ($item) {
                $query->where('question','LIKE',"%{$item}%")
                    ->orWhere('a','LIKE',"%{$item}%")
                     ->orWhere('b','LIKE',"%{$item}%")
                    ->orWhere('c','LIKE',"%{$item}%");
                    })
                    ->orderBy('extract_id','asc')
                    ->orderBy('qno','asc')
                    ->paginate(config('global.no_of_records'));   
        $view = $search ? 'list': 'index';

        return view('appl.'.$this->app.'.'.$this->module.'.'.$view)
                ->with('objs',$objs)
                ->with('obj',$obj)
                ->with('try',true)
                ->with('app',$this);
    }
}

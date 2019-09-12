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
}

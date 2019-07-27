<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Test as Obj;
use App\Models\Admin\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj)
    {
        $this->authorize('view', $obj);
        return view('appl.admin.admin.index');
    }

    public function analytics(Obj $obj){
        $this->authorize('view', $obj);
        $admin = new Admin;
        $data['user'] = $admin->userAnalytics(); 
        $data['group_count'] = $admin->groupCount();
        $data['test_count'] = $admin->testCount();
        $data['product_count'] = $admin->productCount();
        $data['coupon_count'] = $admin->couponCount();
        return view('appl.admin.admin.analytics')->with('data',$data);
    }


   
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Test\Test as Obj;
use App\Models\Admin\Admin;
use App\User;
use App\Models\Product\Coupon;

use App\Mail\contactmessage;
use App\Mail\ErrorReport;
use Illuminate\Support\Facades\Mail;

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
        $data['users'] = User::orderBy('id','desc')->get();
        $data['coupon'] = Coupon::where('code','FA5Y9')->first();
        
        return view('appl.admin.admin.index')->with('data',$data);
    }

    public function analytics(Obj $obj){
        $this->authorize('view', $obj);
        $admin = new Admin;
        $data['user'] = $admin->userAnalytics();
        $data['order'] = $admin->orderAnalytics(); 
        $data['group_count'] = $admin->groupCount();
        $data['test_count'] = $admin->testCount();
        $data['product_count'] = $admin->productCount();
        $data['coupon_count'] = $admin->couponCount();
        return view('appl.admin.admin.analytics')->with('data',$data);
    }

    public function contact(Request $r){
        
        Mail::to(config('mail.report'))->send(new contactmessage($r));
        return view('appl.admin.admin.contactmessage');
    }

    public function notify(Request $r){
         
         
        Mail::to(config('mail.report'))->send(new  ErrorReport($r));
        echo "Successfully reported to administrator.";
    }


   
}

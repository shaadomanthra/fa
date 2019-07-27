<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Test\Test;
use App\Models\Test\Group;
use App\Models\Product\Product;
use App\Models\Product\Coupon;
use App\User;

class Admin extends Model
{
    

    public function userAnalytics(){
    	$data = array();

    	$data['total'] = User::count();

    	$last_year = (new \Carbon\Carbon('first day of last year'))->year;
        $this_year = (new \Carbon\Carbon('first day of this year'))->year;

        $last_year_first_day = (new \Carbon\Carbon('first day of January '.$last_year))->startofMonth()->toDateTimeString();
        $this_year_first_day = (new \Carbon\Carbon('first day of January '.$this_year))->startofMonth()->toDateTimeString();

        $last_year_count  = User::where('created_at','>', $last_year_first_day)->where('created_at','<', $this_year_first_day)->count();
        $this_year_count  = User::where(DB::raw('YEAR(created_at)'), '=', $this_year)->count();

        $data['last_year'] =$last_year_count;
        $data['this_year'] = $this_year_count;


        $last_month_first_day = (new \Carbon\Carbon('first day of last month'))->startofMonth()->toDateTimeString();
        $this_month_first_day = (new \Carbon\Carbon('first day of this month'))->startofMonth()->toDateTimeString();
        
        $last_month  = User::where('created_at','>', $last_month_first_day)->where('created_at','<', $this_month_first_day)->count();
        $this_month  = User::where(DB::raw('MONTH(created_at)'), '=', date('n'))->count();

        $data['last_month'] = $last_month;
        $data['this_month'] = $this_month;

        return $data;
    }


    public function groupCount(){
    	return Group::count();
    }
    public function testCount(){
    	return Test::count();
    }
    public function productCount(){
    	return Product::count();
    }
    public function couponCount(){
    	return Coupon::count();
    }
}

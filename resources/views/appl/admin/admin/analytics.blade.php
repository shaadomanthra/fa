@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item">Analytics</li>
  </ol>
</nav>
<div class="">
    <div class="row ">
        <div class="col-12 col-md-6">
            <div class="bg-white  p-3 "><a href="{{route('user.index')}}"><h3>Users <div class="float-right"><i class="fa fa-user"></i> {{ $data['user']['total']}}</div></h3></a></div>
            <div class="bg-light p-4 mb-4">

                <div class="row">

                    <div class="col-2 col-md-2 col-lg-3">
                        <img src="{{ asset('images/admin/users.png') }}" class="w-100" >
                    </div>

                    <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This month</div>
                        <div class="h3">{{ $data['user']['this_month']}}</div>
                        <div class="h5">Last month</div>
                        <div class="h3">{{ $data['user']['last_month']}}</div>
                    </div>
                     <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This year</div>
                        <div class="h3">{{ $data['user']['this_year']}}</div>
                        <div class="h5">Last year</div>
                        <div class="h3">{{ $data['user']['last_year']}}</div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="bg-white  p-3 "><a href="{{route('user.index')}}"><h3>Transactions <div class="float-right"><i class="fa fa-tag"></i> 20</div></h3></a></div>
            <div class="bg-light p-4 mb-4">

                <div class="row">

                    <div class="col-2 col-md-2 col-lg-3">
                        <img src="{{ asset('images/admin/orders.png') }}" class="w-100" >
                    </div>

                    <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This month</div>
                        <div class="h3">20</div>
                        <div class="h5">Last month</div>
                        <div class="h3">20</div>
                    </div>
                     <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This year</div>
                        <div class="h3">20</div>
                        <div class="h5">Last year</div>
                        <div class="h3">20</div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-secondary rounded text-center">
                <div class=" h3"><a href="{{ route('group.index')}}">Test Groups</a></div>
                <div class="display-3 text-secondary">{{ $data['group_count']}}</div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class=" p-4 border   border-secondary  rounded text-center">
                <div class=" h3"><a href="{{ route('test.index')}}">Tests</a></div>
                <div class="display-3 text-secondary">{{ $data['test_count']}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-secondary rounded text-center">
                <div class=" h3"><a href="{{ route('product.index')}}">Products</a></div>
                <div class="display-3 text-secondary">{{ $data['product_count']}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-secondary rounded text-center">
                <div class=" h3"><a href="{{ route('coupon.index')}}">Coupons</a></div>
                <div class="display-3 text-secondary">{{ $data['coupon_count']}}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Analytics | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
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
            <div class="bg-white  p-3 "><a href="{{route('order.index')}}"><h3>Orders <div class="float-right"><i class="fa fa-tag"></i> {{ $data['order']['total']}}</div></h3></a></div>
            <div class="bg-light p-4 mb-4">

                <div class="row">

                    <div class="col-2 col-md-2 col-lg-3">
                        <img src="{{ asset('images/admin/orders.png') }}" class="w-100" >
                    </div>

                    <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This month</div>
                        <div class="h3">{{ $data['order']['this_month']}}</div>
                        <div class="h5">Last month</div>
                        <div class="h3">{{ $data['order']['last_month']}}</div>
                    </div>
                     <div class="col-5 col-md-5 col-lg-4">
                        <div class="h5">This year</div>
                        <div class="h3">{{ $data['order']['this_year']}}</div>
                        <div class="h5">Last year</div>
                        <div class="h3">{{ $data['order']['last_year']}}</div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-primary list-group-item-primary rounded text-center">
                <div class=" h3"><a href="{{ route('group.index')}}">Test Groups</a></div>
                <div class="display-3">{{ $data['group_count']}}</div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class=" p-4 border   border-primary list-group-item-primary  rounded text-center">
                <div class=" h3"><a href="{{ route('test.index')}}">Tests</a></div>
                <div class="display-3 ">{{ $data['test_count']}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-primary list-group-item-primary rounded text-center">
                <div class=" h3"><a href="{{ route('product.index')}}">Products</a></div>
                <div class="display-3 ">{{ $data['product_count']}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class=" p-4 border  border-primary list-group-item-primary rounded text-center">
                <div class=" h3"><a href="{{ route('coupon.index')}}">Coupons</a></div>
                <div class="display-3 ">{{ $data['coupon_count']}}</div>
            </div>
        </div>
    </div>
</div>
@endsection

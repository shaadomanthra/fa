@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('category.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/category.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Test Categories</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('type.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/type.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Test Types</div>
                </div>
            </div>
            </a>
        </div>

        
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('group.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/group.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Test Groups</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('tag.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/tag.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Question Tags</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('test.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/test.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Tests</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('product.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/products.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Products</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('order.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/orders.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Orders</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('user.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/users.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Users</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('coupon.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/coupon.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Coupons</div>
                </div>
            </div>
            </a>
        </div>
        <!--
         <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('construction') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/email.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Emails</div>
                </div>
            </div>
            </a>
        </div>
        -->
         <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.analytics') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/analytics.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Analytics</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('file.index') }}">
            <div class="border bg-light p-4 rounded mb-4">
                <div>
                    <img src="{{ asset('images/admin/folder.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Files</div>
                </div>
            </div>
            </a>
        </div>

    </div>
</div>
@endsection

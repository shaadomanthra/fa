@extends('layouts.panel')

@section('content')  
<div class="bg" style=""> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 col-md-7">
            <div class="p-3 p-md-5"></div>
    <a class="navbar-brand " href="{{ url('/') }}">
            <img class="mb-2 mt-2" src="{{ asset('images/logo_white2.png') }}" alt="" style="max-width:250px;" >
        </a>
    <div class="heading text-light ">
    The time to be awesome has come
    </div>
    <div class="heading2 mb-5">
    Get started for FREE
    </div>


    @guest
    <a href="{{ route('register')}}">
    <button class="btn btn-success btn-orange btn-lg">Register Now</button>
    </a>
    <a href="{{ route('login')}}">
    <button class="btn btn-primary btn-yellow btn-lg">Login</button>
    </a>
    @else
    <a href="{{ route('home')}}">
    <button class="btn btn-success btn-orange btn-lg">Open Dashboard</button>
    </a>
    @endguest

    <div class="p-5"></div>
    <div class="h4  mb-3" style="color:#a1d5e8">Explore our <a href="{{ route('product.public')}}">
    <button class="btn btn-green btn-lg" style="">products</button>
    </a></div>
    <a href="{{ route('product.view','oet_mock_test_pack')}}">
    <button class="btn btn-outline-light btn-sm mb-2 mr-1">OET Free Test</button>
    </a>
    <a href="{{route('product.view','ielts_free_test')}}">
    <button class="btn btn-outline-light btn-sm mb-2 mr-1">IELTS Free Test</button>
    </a>
    <a href="{{route('product.view','grammar-test')}}">
    <button class="btn btn-outline-light btn-sm mb-2 mr-1">Grammar Test</button>
    </a>
        </div>
        <div class="col-12 col-md-5">
             <div class="p-5 d-none d-md-block"><div class="p-3"></div></div>
             <img class="mb-2 mt-2 d-none d-md-block" src="{{ asset('images/general/front2.png') }}" alt="" width="400" >
        </div>

    </div>
    
    
    <div class="p-5"></div>
</div>
</div>
@endsection
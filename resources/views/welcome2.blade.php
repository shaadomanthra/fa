@extends('layouts.panel')

@section('content')  
<div class="" style="background: linear-gradient(to top, rgba(44, 64, 89,0.6),rgba(0, 0, 0,0.6)), url({{ asset('images/dashboard/bg6.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;min-height:600px; padding:25px;padding-top:90px;"> 
<div class="container ">
    <div class="heading text-light">
    The time to be awesome has come
    </div>
    <div class="heading2 mb-5">
    Get started for FREE
    </div>


    @guest
    <a href="{{ route('register')}}">
    <button class="btn btn-success btn-lg">Register Now</button>
    </a>
    @else
    <a href="{{ route('home')}}">
    <button class="btn btn-success btn-lg">Open Dashboard</button>
    </a>
    @endguest
    <div class="p-5"></div>
    <div>
        <button class="btn btn-outline-light mr-2 mb-3">OET Free Test</button>
        <button class="btn btn-outline-light mr-2 mb-3">IELTS Free Test</button>
        <button class="btn btn-outline-light mr-2 mb-3">GRE</button>
        <button class="btn btn-outline-light mr-2 mb-3">PTE</button>
        <button class="btn btn-outline-light mr-2 mb-3">TOEFL</button>
        <button class="btn btn-outline-light mr-2 mb-3">SAT</button>
    </div>
    <div class="p-5"></div>
</div>
</div>
@endsection
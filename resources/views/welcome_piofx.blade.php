@extends('layouts.front')
@section('title', 'Piofx Media - Assessments for all')
@section('description', 'Assessments for all, powered by a team that crafts training tools for the <br>worlds most widely accepted tests')
@section('content')

<div class="" style="background:#fbf1df;"> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 col-md-8">
            <div class="p-3 p-md-3"></div>
            @guest
            <img class="mb-5" src="{{ asset('images/piofx.png') }}" alt="First Academy" width="100" >
            @endguest
    <div class="heading  mt-5" style="color:#8e867d;font-family: 'Chivo', sans-serif;font-weight: 900;line-height: 1.2">
    Tests for assessments all, big and small!
    </div>
    <div class="heading2  mb-4 mt-3" style="color:#bcb4a6">
    Powered by a team that crafts training tools for the <br>world's most widely accepted tests!
    </div>

    <a href="{{ url('contact')}}">
    <button class="btn  btn-success  btn-lg p-2 pr-4 pl-4 mb-5" style="color: #fff;font-weight: 900;"><b>Get Started for Free</b></button>
    </a>
   <div class="p-4"></div>
     </div>
        <div class="col-12 col-md-4">
             <img class="mb-2 mt-5 d-none d-md-block w-100 p-4" src="{{ asset('images/general/front5.png') }}" alt=""  >
        </div>
    </div>
</div>
</div>


<div class="pr-2 pl-2 pt-4 pb-4 " style="background: #f9f9f9">
 
</div>


@endsection
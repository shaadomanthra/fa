@extends('layouts.first')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')

@section('content')  
<div class="" style="background: #edd8a0"> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 col-md-7">
            <div class="p-3 p-md-5"></div>
    <a class="navbar-brand " href="{{ url('/') }}">
            <img class="mb-2 mt-2" src="{{ asset('images/piofx.png') }}" alt="" style="max-width:250px;" >
        </a>
    <div class="heading  my-3" style="color:#e04c49">
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
    <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <button class="btn btn-primary btn-yellow btn-lg ">Logout</button>
                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
    @endguest

    <div class="p-4"></div>
   
    
        </div>
        <div class="col-12 col-md-5">
             <div class="p-5 d-none d-md-block"><div class="p-3"></div></div>
             <img class="mb-2 mt-2 d-none d-md-block w-100" src="{{ asset('images/general/front5.png') }}" alt=""  >
        </div>
    </div>
    <div class="p-5"></div>
</div>
</div>
@endsection
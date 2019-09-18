@extends('layouts.front')
@section('title', 'Tests | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

<div class="bg" style=""> 
<div class="container ">
    <div class="row p-3 p-md-0">
        <div class="col-12 col-md-8">
            <div class="p-3 p-md-3"></div>
    <div class="heading  text-light ">
    The time to be awesome<br> has come
    </div>
    <div class="heading2  mb-5">
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
        <div class="col-12 col-md-4">
             <img class="mb-2 mt-2 d-none d-md-block w-100 p-4" src="{{ asset('images/general/front5.png') }}" alt=""  >
        </div>
    </div>
</div>
</div>

<div class="bg-light">
<div class="container ">
  <div class="p-3"></div>
<div  class="row ">
  <div class="col-12 col-md-9 col-lg-10">
    <nav class="navbar navbar-light  p-4 rounded justify-content-between  mb-4" style="background:#e8ecef;border:1px solid #cfd5da;">
          <a class=" h2 mb-3 mb-md-0"><i class="fa fa-cubes"></i> Tests @if(request()->get('category')) - {{ strtoupper(request()->get('category'))}} @endif</a>
          <form class="form-inline" method="GET" action="{{ route('tests') }}">
            <div class="input-group input-group-lg">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
          </form>
        </nav>
    <div class="">
      <div class=" ">
        <div id="search-items" class="">
         @include('appl.'.$app->app.'.'.$app->module.'.public_list')
       </div>

     </div>
   </div>
 </div>
 <div class="col-12 col-md-3 col-lg-2">
  <div class=" border rounded bg-light mb-4">
      <h5 class="mb-0 p-3">Category</h5>
    <div class="list-group ">
    <a href="{{ request()->fullUrlWithQuery(['category' => '']) }}" class="list-group-item list-group-item-action list-group-item-warning @if(!request()->get('category'))active @endif">
      All Tests
    </a>

    @foreach($categories as $cat)
    <a href="{{ request()->fullUrlWithQuery(['category' => $cat->slug]) }}" class="list-group-item list-group-item-action list-group-item-warning @if(request()->get('category')==$cat->slug)active @endif">
      {{ $cat->name }}
    </a>
    @endforeach
    
    </div>
  </div>

    <div class=" border rounded bg-light">
      <h5 class="mb-0 p-3">Type</h5>
      <div class="list-group list">

    <a href="{{ request()->fullUrlWithQuery(['type' => ''])  }}" class="list-group-item list-group-item-action list-group-item-secondary @if(request()->get('type')=='')active @endif">
     ALL
    </a>
    <a href="{{ request()->fullUrlWithQuery(['type' => 'free'])  }}" class="list-group-item list-group-item-action list-group-item-secondary @if(request()->get('type')=='free')active @endif">
     FREE
    </a>
     <a href="{{ request()->fullUrlWithQuery(['type' => 'premium']) }}" class="list-group-item list-group-item-action list-group-item-secondary @if(request()->get('type')=='premium')active @endif">
     PERMIUM
    </a>
   
    </div>
    </div>
 </div>
</div>
</div>
</div>
@endsection
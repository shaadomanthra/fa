@extends('layouts.app')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@if( \auth::user()->activation_token!=1 || \auth::user()->sms_token!=1)
<div class="rounded p-4 mb-4" style="background: #caf7dd; border:1px solid #39c072;"><h4 class="">Validate your account</h4>
<p>Your account has not been validated yet. You are only a few steps away from complete access to our platform.</p>
<a href="{{ route('activation')}}">
<button class="btn btn-success">Validate Now</button>
</a>
</div>
@endif
<div class="">
  <div class="row no-gutters">
    <div class="col-12  col-md-5 col-lg-4 d-block d-sm-none d-md-block">
      <div class="card mb-4 mr-2 mr-md-4">
        <div class="bg-image" style="background-image: url({{asset('images/bg/bg5.jpg')}})"> 
        </div>
        <div class="user_container">
          <img src="{{ asset('images/admin/user.png')}}" class="user" />
        </div>
        <div class="card-body pt-0 text-center mb-3">
          <div class="h4 mb-4 mt-4">Hi, {{ \auth::user()->name}}! </div>
          <p>Develop a passion for learning. If you do, you will never cease to grow <br><span class="text-secondary">-Anthony J Dangelo</span></p>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <button class="btn btn-success">Logout</button>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        
      </div>
    </div>
  </div>

    <div class="col-12  col-md-5 col-lg-4 d-none d-sm-block d-md-none">
      <div class="card mb-4 mr-2 mr-md-4">
       
            <div class="bg-image" style="background-image: url({{asset('images/bg/bg5.jpg')}})"> 
        </div>
              
        <div class="card-body pt-0  mb-3">

          <img src="{{ asset('images/admin/user.png')}}" class="float-right" style="width:120px;margin:30px;margin-top: -50px;" />
            <div class="h4 mb-4 mt-4">Hi, {{ \auth::user()->name}}! </div>
          
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <button class="btn btn-success">Logout</button>
          </a>
           
      

        

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        
      </div>
    </div>
  </div>

  
  <div class="col-12  col-md-7 col-lg-8">
    

@if(auth::user()->orders()->where('status',1)->count()!=0)
<div class="mb-4">
  @include('appl.pages.blocks.tests')
</div>
@endif

<div class="" style="">
  @include('blocks.free_listening_tests2')
</div>
<div class="">
  @include('blocks.free_reading_tests2')
</div>


</div>

</div>
</div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@if( \auth::user()->activation_token!=1 || \auth::user()->sms_token!=1)
<div class="rounded p-4 mb-4" style="background: #98deb5; border:1px solid #39c072;"><h4 class="">Validate your account</h4>
<p>Your account has not been validated yet. You are only a few steps away from complete access to our platform.</p>
<a href="{{ route('activation')}}">
<button class="btn btn-success">Validate Now</button>
</a>
</div>
@endif
<div class="">
  <div class="row ">
    <div class="col-12 col-sm-6 col-md-5 col-lg-4">
      <div class="card mb-4">
        <div class="bg-image" style="background-image: url({{asset('images/dashboard/bg2.jpg')}})"> 
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

  
  <div class="col-12 col-sm-6 col-md-7 col-lg-8">
    <div class="row">
      <div class="col-12 col-md-6">
       <div class="card mb-3 mb-md-0" style="background:rgb(205, 239, 255);border:1px solid #93c4da ;">
        <div class="card-header">
          <b>Speaking Evaluation</b>
        </div>
        <div class="card-body">
          <p class="card-text">Get your speaking tasks evaluated by expert trainers.</p>
          <a href="{{ route('product.view','speaking-evaluation')}}" class="btn btn-outline-secondary">more details</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
     <div class="card " style="background:#fffbd6;border:1px solid #bbb89f;">
       <div class="card-header">
        Writing Evaluation
      </div>
      <div class="card-body">
        <p class="card-text">Get your writing tasks evaluated by expert trainers.</p>
        <a href="{{ route('product.view','writing-evaluation')}}" class="btn btn-outline-secondary">more details</a>
      </div>
    </div>
  </div>

</div>

@if(auth::user()->orders()->where('status',1)->count()!=0)
  @include('appl.pages.blocks.tests')
@endif


</div>

</div>
</div>
</div>
@endsection

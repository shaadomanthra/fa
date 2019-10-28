@extends('layouts.app')
@section('title', 'Tests | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')



@include('flash::message')
<div  class="row ">
  <div class="col-12 col-md-9 col-lg-10">
    <nav class="navbar navbar-light  p-4 rounded justify-content-between  mb-4" style="background:transparent;border:1px solid #d3e1e8;">
          <a class=" h2 mb-3 mb-md-0"><i class="fa fa-check-square-o"></i> Tests @if(request()->get('category')) - {{ strtoupper(request()->get('category'))}} @endif</a>
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
      <div class="">
        <div id="search-items" class="">
         @include('appl.'.$app->app.'.'.$app->module.'.public_list2')
       </div>

     </div>
     
   </div>
 </div>
 <div class="col-12 col-md-3 col-lg-2">
  <div class=" border rounded bg-light mb-4">
      <h5 class="mb-0 p-3">Category</h5>
    <div class="list-group ">
    <a href="{{ route('tests') }}" class="list-group-item list-group-item-action list-group-item-warning @if(!request()->get('category'))active @endif">
      All Tests
    </a>

    @foreach($categories as $cat)
    <a href="{{ route('tests') }}?category={{  $cat->slug}}" class="list-group-item list-group-item-action list-group-item-warning @if(request()->get('category')==$cat->slug)active @endif">
      {{ $cat->name }}
    </a>
    @endforeach
    
    </div>
  </div>

    <div class=" border rounded bg-light">
      <h5 class="mb-0 p-3">Type</h5>
      <div class="list-group list">

    <a href="{{ route('tests') }}?type=free" class="list-group-item list-group-item-action list-group-item-secondary @if(request()->get('type')=='free')active @endif">
     FREE
    </a>
     <a href="{{ route('tests') }}?type=premium" class="list-group-item list-group-item-action list-group-item-secondary @if(request()->get('type')=='premium')active @endif">
     PERMIUM
    </a>
   
    </div>
    </div>
 </div>
</div>
@endsection
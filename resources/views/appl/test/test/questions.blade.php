@extends('layouts.app')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/test')}}">Test</a></li>
    <li class="breadcrumb-item"><a href="{{ route('test.show',$test->id)}}">{{$test->name}}</a></li>
    <li class="breadcrumb-item">Questions</li>
  </ol>
</nav>

@include('flash::message')
<div  class="row ">

  <div class="col-12 col-md-9">
 
    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <nav class="navbar navbar-light bg-light justify-content-between border mb-3">
          <a class="navbar-brand"><i class="fa fa-bars"></i>  Questions </a>

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

 
           <div class="btn " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Create
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{ route('mcq.create',$test->id)}}">MCQ</a>
      <a class="dropdown-item" href="{{ route('fillup.create',$test->id)}}">Fillup</a>
    </div>
  </div>


          <form class="form-inline" method="GET" action="{{ route('test.questions',$test->id) }}">


            
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
            
          </form>
        </nav>

        <div id="search-items">
         @include('appl.test.test.qlist')
       </div>

     </div>
   </div>
 </div>

  <div class="col-12 col-md-3">
      @include('appl.test.snippets.menu')
    </div>
 
</div>

@endsection



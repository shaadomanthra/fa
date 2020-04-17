@extends('layouts.bg')
@section('title', 'Sections | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

<div class="bg-white py-2 mb-4">
<div class="container">
<nav >
  <ol class="breadcrumb bg-white p-0 py-2">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/test')}}">Test</a></li>
    <li class="breadcrumb-item"><a href="{{ route('test.show',$app->test->id)}}">{{$app->test->name}}</a></li>
    <li class="breadcrumb-item">
      Section
    </li>
  </ol>
</nav>

<div class="mb-3">

          <p class="h2 mb-2 d-inline" >
            <i class="fa fa-bars "></i> 
            Sections
          </p>

          <form class="form-inline float-right" method="GET" action="{{ route($app->module.'.index',$app->test->id) }}">

            @can('create',$obj)
            <a href="{{route($app->module.'.create',$app->test->id)}}" class="btn btn-outline-success   mr-sm-3">
              Create Section
            </a>
            @endcan
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
            
          </form>
         

</div>

</div>
</div>


<div class="container">

@include('flash::message')
<div  class="row ">

  <div class="col-12 col-md-10">
 
    <div class=" mb-3 mb-md-0">
       

        <div id="search-items">
         @include('appl.'.$app->app.'.'.$app->module.'.list')
       </div>

   </div>
 </div>

  <div class="col-12 col-md-2">
      @include('appl.test.snippets.menu')
    </div>
 
</div>
</div>
@endsection



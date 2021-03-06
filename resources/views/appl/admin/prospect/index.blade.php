@extends('layouts.app')
@include('meta.index')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
     <li class="breadcrumb-item"><a href="{{ url('/admin/prospect/dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item">{{ ucfirst($app->module) }}</li>
  </ol>
</nav>

@include('flash::message')
<div  class="row ">

  <div class="col-12 col-md-9">
 
    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <nav class="navbar navbar-light bg-light justify-content-between border mb-3">
          <a class="navbar-brand"><i class="fa fa-bars"></i> {{ ucfirst($app->module) }} </a>

          <form class="form-inline" method="GET" action="{{ route($app->module.'.index') }}">

            @can('create',$obj)
            <a href="{{route($app->module.'.create')}}">
              <button type="button" class="btn btn-success my-2 my-sm-2 mr-sm-3">Create {{ ucfirst($app->module) }}</button>
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
        </nav>

        @if(request()->get('user_id') || request()->get('stage') || request()->get('range'))
          <div class="alert alert-important alert-primary">
            @if(request()->get('user_id'))
            <b>Counsellor: </b> {{\auth::user()->getUser(request()->get('user_id'))->name}} &nbsp; &nbsp;
            @endif
            @if(request()->get('stage'))
            <span class=""><b>Stage: </b>  {{ Ucfirst(request()->get('stage'))}}</span>&nbsp; &nbsp;
            @endif
            @if(request()->get('range'))
            <span class=""><b>Range: </b>  {{ Ucfirst(request()->get('range'))}}</span>
            @endif
          </div>
        @endif
        <div id="search-items">
         @include('appl.'.$app->app.'.'.$app->module.'.list')
       </div>

     </div>
   </div>
 </div>
 <div class="col-12 col-md-3">
    @include('appl.'.$app->app.'.snippets.menu')
 </div>
 
</div>

@endsection



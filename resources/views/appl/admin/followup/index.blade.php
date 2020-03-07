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
        <nav class=" bg-light p-3  border mb-3">
          <a class="navbar-brand"><i class="fa fa-bars"></i> {{ ucfirst($app->module) }} </a>

          <span class="float-right">
            
             @can('create',$obj)
            <a href="{{route($app->module.'.create')}}">
              <button type="button" class="btn btn-secondary ">Create {{ ucfirst($app->module) }}</button>
            </a>
            @endcan
          </span>
          
        </nav>

        @if(request()->get('user_id') || request()->get('today') )
          <div class="alert alert-important alert-primary">
            @if(request()->get('user_id'))
            <b>Counsellor: </b> {{\auth::user()->getUser(request()->get('user_id'))->name}} &nbsp; &nbsp;
            @endif
            
            @if(request()->get('today'))
            <span class=""><b>Today: </b>  yes</span> &nbsp; &nbsp;
            @endif

            @if(!request()->get('state'))
            <span class=""><b>State: </b>  Complete</span> &nbsp; &nbsp;
            @endif

            @if(request()->get('state')==1)
            <span class=""><b>State: </b>  Open</span>&nbsp; &nbsp;
            @endif

            @if(request()->get('state')==2)
            <span class=""><b>State: </b>  Incomplete</span>&nbsp; &nbsp;
            @endif

            @if(request()->get('view'))
            <span class=""><b>View: </b>  All Prospect Followup Entries</span>&nbsp; &nbsp;
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



@extends('layouts.app')
@include('meta.index')
@section('content')

<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a> </li>
  </ol>
</nav>

@include('flash::message')
<div  class="row ">

  <div class="col-12 col-md-9">
 
    <div id="search-items">
         @include('appl.'.$app->app.'.'.$app->module.'.list')
    </div>
 </div>
 <div class="col-12 col-md-3">
  @auth
  @if(\auth::user()->isAdmin())
    @include('appl.'.$app->app.'.snippets.menu')
  @endif
  @endauth

    @include('appl.'.$app->app.'.snippets.search')
    <div class="h3  pb-3">Read about</div>
        @include('appl.blog.snippets.categories')
        <div class="h3 pt-3 pb-3" >Other posts</div>
        @include('appl.blog.snippets.dates')
        
 </div>
 
</div>

@endsection



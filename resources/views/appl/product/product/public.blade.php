@extends('layouts.app')
@section('content')


@include('flash::message')


<div  class="row ">

  <div class="col-12 col-md-12">
    <nav class="navbar navbar-light bg-white p-3 rounded justify-content-between border mb-3">
          <a class="navbar-brand"><i class="fa fa-cubes"></i> {{ ucfirst($app->module) }}s </a>

          <form class="form-inline" method="GET" action="{{ route($app->module.'.public') }}">

            <div class="input-group ">
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
        <div id="search-items" class="row">
         @include('appl.'.$app->app.'.'.$app->module.'.public_list')
       </div>

     </div>
     <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
  {{$objs->appends(request()->except(['page','search']))->links()  }}
    </nav>
   </div>
 </div>

 
</div>

@endsection



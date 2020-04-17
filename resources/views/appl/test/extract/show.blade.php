@extends('layouts.bg')
@include('meta.show')
@section('content')

<div class="bg-white py-2 mb-4">
<div class="container">
<nav >
  <ol class="breadcrumb bg-white p-0 pt-2">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/test')}}">Test</a></li>
    <li class="breadcrumb-item"><a href="{{ route('test.show',$app->test->id)}}">{{$app->test->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index',[$app->test->id]) }}">@if(in_array(strtolower($app->test->testtype->name),['listening','reading']))
  Extracts
  @else
  Passages
  @endif</a></li>
    <li class="breadcrumb-item">@if($obj->name) {{ $obj->name }} @else - @endif</li>
  </ol>
</nav>
</div>
</div>





<div class="container">
  @include('flash::message')
<div class="row"> 

     <div class="col-12 col-md-10">
      <h3 class="py-3"> <i class="fa fa-gg"></i> Preview

      @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',[$app->test->id,$obj->id]) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
            </span>
            @endcan
          </h3>
     <div class="p-3 bg-white border-top mb-4">
        <div class="">
        </div>
  <div class="option rounded p-4 border ">
    <h4 class="mb-3"><i class="fa fa-check-square-o"></i> {{ $obj->name }} </h4>
    {!!$obj->text !!}</div>

      </div>


      @if(!in_array(strtolower($app->test->testtype->name),['grammar','english']))
      <div class="card mb-4">
        <div class="card-body">

    
          @if(!in_array(strtolower($app->test->testtype->name),['grammar']))
          <div class="row mb-2">
            <div class="col-md-4"><b>Section</b></div>
            <div class="col-md-8">
              @if($obj->section)
              <a href="{{ route('section.show',[$app->test->id,$obj->section->id]) }}">
                {{ $obj->section->name }}
              </a>
              @else
              - NA -
              @endif
            </div>
          </div>
          @endif
         
         @if(in_array(strtolower($app->test->testtype->name),['listening']))
           <div class="row mb-2">
            <div class="col-md-4"><b>Seek Time</b></div>
            <div class="col-md-8">
              @if($obj->seek_time)
                {{ $obj->seek_time}} sec
               @else
                - NA -
               @endif 
           
            </div>
          </div>
          @endif

          <div class="row mb-0">
            <div class="col-md-4"><b>Layout</b></div>
            <div class="col-md-8">
              @if($obj->layout)
                {{ $obj->layout}} 
               @else
                - NA -
               @endif 
           
            </div>
          </div>
          
          
        </div>
      </div>
      @endif
    </div>
       <div class="col-12 col-md-2">
      @include('appl.test.snippets.menu')
    </div>
  </div>
</div>



  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This following action is permanent and it cannot be reverted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <form method="post" action="{{route($app->module.'.destroy',[$app->test->id,$obj->id])}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<button type="submit" class="btn btn-danger">Delete Permanently</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
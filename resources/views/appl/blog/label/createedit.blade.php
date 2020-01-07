@extends('layouts.app')
@section('title', 'Tag Create | First Academy')
@section('description', 'tag creation or updation')
@section('content')

@include('flash::message')
  <div class="card">
    <div class="card-body">

      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
      @endif 
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create')
          Create Tag
        @else
          Update Tag
        @endif  

        <button type="submit" class="btn btn-outline-success float-right">Save</button>
       </h1>
      
      

      <div class="row">
        <div class="col-12 col-md-6">

          <div class="form-group">
            <label for="formGroupExampleInput "> Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the tag name" 
                @if($stub=='Create')
                value="{{ (old('name')) ? old('name') : '' }}"
                @else
                value = "{{ $obj->name }}"
                @endif
              >
          </div>


        </div>
        <div class="col-12 col-md-6">
          
          <div class="form-group">
            <label for="formGroupExampleInput "> slug</label>
            <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the tag slug separated by hyphen" 
                @if($stub=='Create')
                value="{{ (old('slug')) ? old('slug') : '' }}"
                @else
                value = "{{ $obj->slug }}"
                @endif
              >
          </div>

          

        </div>
      </div>
      


     

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-success">Save</button>
    </form>
    </div>
  </div>
@endsection
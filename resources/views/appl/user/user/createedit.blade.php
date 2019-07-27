@extends('layouts.app')
@section('content')

@include('flash::message')
  <div class="card">
    <div class="card-body">
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create')
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  
       </h1>
      
      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
      @endif  
      <div class="form-group">
        <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Name</label>
        <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the Name" 
            @if($stub=='Create')
            value="{{ (old('name')) ? old('name') : '' }}"
            @else
            value = "{{ $obj->name }}"
            @endif
          >
      </div>
      
       <div class="form-group">
        <label for="formGroupExampleInput ">Email</label>
        <input type="text" class="form-control" name="email" id="formGroupExampleInput" placeholder="Enter the Email" 
            @if($stub=='Create')
            value="{{ (old('email')) ? old('email') : '' }}"
            @else
            value = "{{ $obj->email }}"
            @endif
          >
      </div>
       <div class="form-group">
        <label for="formGroupExampleInput ">Phone</label>
        <input type="text" class="form-control" name="phone" id="formGroupExampleInput" placeholder="Enter the phone number" 
            @if($stub=='Create')
            value="{{ (old('phone')) ? old('phone') : '' }}"
            @else
            value = "{{ $obj->phone }}"
            @endif
          >
      </div>

      
     

      <div class="form-group">
        <label for="formGroupExampleInput ">Status</label>
        <select class="form-control" name="status">
          <option value="1" @if(isset($obj)) @if($obj->status==1) selected @endif @endif >Active</option>
          <option value="0" @if(isset($obj)) @if($obj->status==0) selected @endif @endif >Blocked</option>
        </select>
      </div>

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-info">Save</button>
    </form>
    </div>
  </div>
@endsection
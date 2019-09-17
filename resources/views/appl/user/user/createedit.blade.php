@extends('layouts.app')
@include('meta.createedit')
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
        <label for="formGroupExampleInput ">ID Number</label>
        <input type="text" class="form-control" name="idno" id="formGroupExampleInput" placeholder="Enter the id number (optional)" 
            @if($stub=='Create')
            value="{{ (old('idno')) ? old('idno') : '' }}"
            @else
            value = "{{ $obj->idno }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput "> Name</label>
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

      
     @if(\auth::user()->admin==1)
     <div class="form-group">
        <label for="formGroupExampleInput ">Role</label>
        <select class="form-control" name="admin">
          
          <option value="0" @if(isset($obj)) @if($obj->admin===0) selected @endif @endif >User</option>
          <option value="1" @if(isset($obj)) @if($obj->admin==1) selected @endif  @endif >Administrator</option>
          <option value="2" @if(isset($obj)) @if($obj->admin===2) selected @endif @endif >Employee</option>
        </select>
      </div>
     @endif

     

      <div class="form-group">
        <label for="formGroupExampleInput ">Status</label>
        <select class="form-control" name="status">
          <option value="1" @if(isset($obj)) @if($obj->status==1) selected @else selected @endif  @endif >Active</option>
          <option value="0" @if(isset($obj)) @if($obj->status===0) selected @endif @endif >Blocked</option>
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
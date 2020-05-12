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
        <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Name</label>
        <input type="text" class="form-control" name="name" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('name')) ? old('name') : $obj->name }}"
            @else
            value = "{{ $obj->name }}"
            @endif
          >
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Domains</label>
        <input type="text" class="form-control" name="domains" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('domains')) ? old('domains') : $obj->domains }}"
            @else
            value = "{{ $obj->domains }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">User</label><br>

        <select class="form-control" name="user_id">
          @foreach($users as $emp)
          <option value="{{$emp->id}}" @if(isset($obj)) @if($obj->user_id==$emp->id) checked @endif  @endif  >{{$emp->name}}</option>
          @endforeach
        </select>

        
      </div>

      <div class="form-group">
            <label for="formGroupExampleInput ">Config</label>
            <textarea class="form-control " name="config"  rows="3">@if($stub=='Create'){{ (old('config')) ? old('config') : '' }}@else @if(isset($obj->comment)) {{ $obj->comment }}@endif @endif</textarea>
      </div>

      

      <div class="form-group">
        <label for="formGroupExampleInput ">status</label>
        <select class="form-control" name="status">
          <option value="0" @if(isset($obj)) @if($obj->status==0) selected @endif @endif >Inactive</option>
          <option value="1" @if(isset($obj)) @if($obj->status==1) selected @endif @endif >Active</option>
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
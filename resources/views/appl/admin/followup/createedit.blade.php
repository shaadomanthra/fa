@extends('layouts.app')
@include('meta.createedit')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/followup')}}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">Create</li>
  </ol>
</nav>
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
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  

        <button type="submit" class="btn btn-outline-success float-right">Save</button>
       </h1>
      
      


          @if(request()->get('name'))
          <div class="form-group">
            <label for="formGroupExampleInput "> Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the user name" 
                value = "{{ request()->get('name') }}" disabled 
              >

              <input type="hidden" class="form-control" name="prospect_id" id="formGroupExampleInput" 
                value = "" 
              >
          </div>
          @endif

          <div class="form-group">
            <label for="formGroupExampleInput "> Phone number</label>
            <input type="text" class="form-control" name="phone" id="formGroupExampleInput" placeholder="Enter the user phone number" 
                @if($stub=='Create')
                value="{{ (old('phone')) ? old('phone') : '' }}"
                @else  value="{{ request()->get('phone') }}" @endif
                
              >
          </div>

  
          

          <div class="form-group">
            <label for="formGroupExampleInput ">Counsellor </label>
            <input type="text" class="form-control" name="counsellor" value="{{\auth::user()->name}}" disabled >
            <input type="hidden" class="form-control" name="user_id" value="{{\auth::user()->id}}">
          </div>
         



      <div class="form-group">
        <label for="formGroupExampleInput ">Comment</label>
        <textarea class="form-control " name="comment"  rows="3">@if($stub=='Create'){{ (old('comment')) ? old('comment') : '' }}@else{{ $obj->comment }}@endif</textarea>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Schedule Followup Call (optional)</label>
        <input type="text" class=" form-control" value="" name="schedule" id="datetimepicker"/>
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
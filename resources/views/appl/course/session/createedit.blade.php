@extends('layouts.app')
@section('title', 'Category Form | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
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
      <form method="post" action="{{route($app->module.'.store',$app->track)}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',[$app->track,$obj->id])}}" enctype="multipart/form-data">
      @endif  

      <div class='row'>
        <div class="col-12 col-md-4">
          <div class="form-group">
        <label for="formGroupExampleInput ">{{ ucfirst($app->module)}} Name</label>
        <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter the Category Name" 
            @if($stub=='Create')
            value="{{ (old('name')) ? old('name') : '' }}"
            @else
            value = "{{ $obj->name }}"
            @endif
          >
      </div>

        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
        <label for="formGroupExampleInput ">Slug</label>
        <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the unique identifier" 
            @if($stub=='Create')
            value="{{ (old('slug')) ? old('slug') : $slug }}"
            @else
            value = "{{ $obj->slug }}"
            @endif
          >
      </div>

        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
        <label for="formGroupExampleInput ">Faculty Name</label>
        <input type="text" class="form-control" name="faculty" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('faculty')) ? old('faculty') : '' }}"
            @else
            value = "{{ $obj->faculty }}"
            @endif
          >
      </div>

        </div>

      </div>
      
      
      


      <div class="form-group">
        <label for="formGroupExampleInput ">Description</label>
        <textarea class="form-control summernote" name="description"  rows="5">
            @if($stub=='Create')
            {{ (old('description')) ? old('description') : '' }}
            @else
            {{ $obj->description }}
            @endif
        </textarea>
      </div>

      <div class='row'>
        <div class="col-12 col-md-4">
          <div class="form-group">
        <label for="formGroupExampleInput ">Meeting URL</label>
        <input type="text" class="form-control" name="meeting_url" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('meeting_url')) ? old('meeting_url') : '' }}"
            @else
            value = "{{ $obj->meeting_url }}"
            @endif
          >
      </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
        <label for="formGroupExampleInput ">Meeting ID</label>
        <input type="text" class="form-control" name="meeting_id" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('meeting_id')) ? old('meeting_id') : '' }}"
            @else
            value = "{{ $obj->meeting_id }}"
            @endif
          >
      </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
        <label for="formGroupExampleInput ">Meeting Password</label>
        <input type="text" class="form-control" name="meeting_password" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('meeting_password')) ? old('meeting_password') : '' }}"
            @else
            value = "{{ $obj->meeting_password }}"
            @endif
          >
      </div>
        </div>
        
      </div>

      <div class='p-3 border bg-light rounded mb-3'>If you enter Meeting URL, leave the meeting id & password empty and vice versa.</div>
      
      
     

      <div class="form-group">
        <label for="formGroupExampleInput ">Status</label>
        <select class="form-control" name="status">
          <option value="0" @if(isset($obj)) @if($obj->status==0) selected @endif @endif >Inactive</option>
          <option value="1" @if(isset($obj)) @if($obj->status==1) selected @endif @endif >Active</option>
        </select>
      </div>

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="user_id" value="{{ \auth::user()->id }}">
        <input type="hidden" name="track_id" value="{{ $app->track_id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-info">Save</button>
    </form>
    </div>
  </div>
@endsection
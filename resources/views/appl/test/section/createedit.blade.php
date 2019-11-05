@extends('layouts.app')
@section('title', 'Section Form | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@include('flash::message')
  <div class="card">
    <div class="card-body">
      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store',$app->test->id)}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',[$app->test->id,$obj->id])}}" enctype="multipart/form-data">
      @endif  
      <h1 class="p-3 border bg-light mb-3">
        @if($stub=='Create')
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  

        <span class="float-right">
        <button type="submit" class="btn btn-primary btn-lg">Save</button>
      </span>
       </h1>
      
      
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
        <label for="formGroupExampleInput ">Slug</label>
        <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the unique identifier" 
            @if($stub=='Create')
            value="{{ (old('slug')) ? old('slug') : $app->slug }}"
            @else
            value = "{{ $obj->slug }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Test</label>
        <input type="text" class="form-control" name="test_" id="formGroupExampleInput" value="{{$app->test->name}}" disabled>
      </div>

      
      <div class="form-group">
        <label for="formGroupExampleInput ">Instructions/Details</label>
        <textarea class="form-control summernote" name="instructions"  rows="5">
            @if($stub=='Create')
            {{ (old('instructions')) ? old('instructions') : '' }}
            @else
            {{ $obj->instructions }}
            @endif
        </textarea>
      </div>

      
      @if($app->test->testtype->name=='LISTENING')
       <div class="form-group">
        <label for="formGroupExampleInput ">Seek Time (seconds)</label>
        <input type="text" class="form-control" name="seek_time" id="formGroupExampleInput" placeholder="Enter the seek time in seconds" 
            @if($stub=='Create')
            value="{{ (old('seek_time')) ? old('seek_time') : '' }}"
            @else
            value = "{{ $obj->seek_time }}"
            @endif
          >
      </div>
      @endif

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
        <input type="hidden" name="type" value="fillup">
      @endif
      <input type="hidden" name="type" value="fillup">
       <input type="hidden" name="test_id" value="{{ $app->test->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-primary btn-lg">Save</button>
    </form>
    </div>
  </div>
@endsection
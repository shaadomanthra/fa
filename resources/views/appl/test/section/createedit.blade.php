@extends('layouts.app')
@section('title', 'Section Form | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@include('flash::message')
  <div class="bg-white ">
    <div class="">
      @if($stub=='Create')
      <form method="post" action="{{route($app->module.'.store',$app->test->id)}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',[$app->test->id,$obj->id])}}" enctype="multipart/form-data">
      @endif  
      <h1 class="p-4   mb-3" style="background: #e7f2f9;border-bottom:2px solid #cee8f7">
        @if($stub=='Create')
          Create {{ $app->module }}
        @else
          Update {{ $app->module }}
        @endif  

        <span class="float-right">
        <button type="submit" class="btn btn-primary btn-lg">Save</button>
      </span>
       </h1>
      
      <div class="p-4">
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
      
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
        <label for="formGroupExampleInput ">Slug (unique identifier)</label>
        <input type="text" class="form-control" name="slug" id="formGroupExampleInput" placeholder="Enter the unique identifier" 
            @if($stub=='Create')
            value="{{ (old('slug')) ? old('slug') : $app->slug }}"
            @else
            value = "{{ $obj->slug }}"
            @endif disabled
          >
          <small  class="form-text text-muted">This column is for internal reference to uniquely identify this section. </small>
      </div>
        </div>
        <div class="col-12 col-md-4">
           <div class="form-group">
        <label for="formGroupExampleInput ">Test</label>
        <input type="text" class="form-control" name="test_" id="formGroupExampleInput" value="{{$app->test->name}}" disabled>
      </div>
        </div>
        <div class="col-12 col-md-4">
          @if(strtoupper($app->test->testtype->name)=='LISTENING')
       <div class="form-group">
        <label for="formGroupExampleInput ">Seek Time (seconds)</label>
        <input type="text" class="form-control" name="seek_time" id="formGroupExampleInput" placeholder="Enter the seek time in seconds" 
            @if($stub=='Create')
            value="{{ (old('seek_time')) ? old('seek_time') : '' }}"
            @else
            value = "{{ $obj->seek_time }}"
            @endif
          >
           <small  class="form-text text-muted">Mention the music track seek position in seconds. Enter -1 if you dont want to show the play button for the section.</small>
      </div>
      @elseif(strtoupper($app->test->testtype->name)=='DUOLINGO')
      <div class="form-group">
        <label for="formGroupExampleInput ">Timer</label>
        <input type="text" class="form-control" name="seek_time" id="formGroupExampleInput" placeholder="Enter the time in seconds" 
            @if($stub=='Create')
            value="{{ (old('seek_time')) ? old('seek_time') : '' }}"
            @else
            value = "{{ $obj->seek_time }}"
            @endif
          >
           <small  class="form-text text-muted">Mention who long the user can see this section</small>
      </div>
      @endif
        </div>
      </div>
      

     

      <div class="row">
        <div class="col-12 col-md-8">
           <div class="form-group">
        <label for="formGroupExampleInput ">Instructions/Details (optional)</label>
        <textarea class="form-control summernote" name="instructions"  rows="5">
            @if($stub=='Create')
            {{ (old('instructions')) ? old('instructions') : '' }}
            @else
            {{ $obj->instructions }}
            @endif
        </textarea>
        <small  class="form-text text-muted">This content is mentioned below the section name in the test page. Leave it blank if you dont want to show any extra details.</small>
      </div>

        </div>
        <div class="col-12 col-md-4">
          <label for="formGroupExampleInput ">&nbsp;</label>
          <div class="card p-3 bg-light">
          <label for="formGroupExampleInput ">Help image</label>
          @if(strtoupper($app->test->testtype->name)=='LISTENING')
          <img src="{{ asset('images/tests/section_help_listening.png')}}" class="w-100">
          @else
          <img src="{{ asset('images/tests/section_help_general.png')}}" class="w-100">
          @endif
        </div>
        </div>
      </div>
     

      
      

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
        <input type="hidden" name="type" value="fillup">
      @endif
      <input type="hidden" name="type" value="fillup">
       <input type="hidden" name="test_id" value="{{ $app->test->id }}">
       <input type="hidden" name="slug" value="@if(isset($obj->slug)) {{$obj->slug}} @else {{$app->slug}} @endif">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-primary btn-lg">Save</button>
    </form>
  </div>
    </div>

  </div>

@endsection
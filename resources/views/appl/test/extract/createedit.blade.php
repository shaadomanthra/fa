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
      <form method="post" action="{{route($app->module.'.store',$app->test->id)}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',[$app->test->id,$obj->id])}}" enctype="multipart/form-data">
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
      
     
     @if(count($sections))

       <div class="form-group">
        <label for="formGroupExampleInput ">Section</label>
        <select class="form-control" name="section_id">
          @foreach($sections as $section)
          <option value="{{$section->id}}" @if(isset($obj)) @if($obj->section_id == $section->id) selected @endif @endif >{{ $section->name }}</option>
          @endforeach
        </select>
      </div>
      @endif

        

      
      <div class="form-group">
        <label for="formGroupExampleInput ">Text</label>
        <textarea class="form-control summernote" name="text"  rows="5">
            @if($stub=='Create')
            {{ (old('text')) ? old('text') : '' }}
            @else
            {{ $obj->text }}
            @endif
        </textarea>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Layout</label>
        <select class="form-control" name="layout">
          <option value="default" @if(isset($obj)) @if($obj->layout == 'default') selected @endif @endif > Default </option>
          <option value="ielts_paragraph" @if(isset($obj)) @if($obj->layout == 'ielts_paragraph') selected @endif @endif > IELTS Paragraph </option>
          <option value="ielts_number" @if(isset($obj)) @if($obj->layout == 'ielts_number') selected @endif @endif > IELTS Number </option>
          <option value="ielts_label" @if(isset($obj)) @if($obj->layout == 'ielts_label') selected @endif @endif > IELTS Label </option>
          <option value="gre_selection" @if(isset($obj)) @if($obj->layout == 'gre_selection') selected @endif @endif > GRE Selection </option>
          <option value="dropdown" @if(isset($obj)) @if($obj->layout == 'dropdown') selected @endif @endif > Dropdown </option>
          <option value="cloze_test" @if(isset($obj)) @if($obj->layout == 'cloze_test') selected @endif @endif > Cloze Test </option>
          <option value="dropin" @if(isset($obj)) @if($obj->layout == 'dropin') selected @endif @endif >Drop In </option>
        </select>
      </div>


        <input type="hidden" class="form-control" name="glance_time" id="formGroupExampleInput" value="0"
          >

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

   
     

      

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
       <input type="hidden" name="test_id" value="{{ $app->test->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-info">Save</button>
    </form>
    </div>
  </div>
@endsection
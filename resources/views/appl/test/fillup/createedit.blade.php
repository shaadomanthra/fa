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
      <form method="post" action="{{route($app->module.'.store',$app->test->id)}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',[$app->test->id,$obj->id])}}" enctype="multipart/form-data">
      @endif  
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="form-group">
        <label for="formGroupExampleInput ">Sno</label>
        <input type="text" class="form-control" name="sno" id="formGroupExampleInput" 
            @if($stub=='Create')
            value="{{ (old('sno')) ? old('sno') : $app->sno }}"
            @else
            value = "{{ $obj->sno }}"
            @endif
          >
      </div>

        </div>
        <div class="col-12 col-md-6">
          <div class="form-group">
        <label for="formGroupExampleInput ">Qno</label>
        <input type="text" class="form-control" name="qno" id="formGroupExampleInput" placeholder="Enter the Question number" 
            @if($stub=='Create')
            value="{{ (old('qno')) ? old('qno') : '' }}"
            @else
            value = "{{ $obj->qno }}"
            @endif
          >
      </div>
          
        </div>

      </div> 

      <div class="form-group">
        <label for="formGroupExampleInput ">Test</label>
        <input type="text" class="form-control" name="test_" id="formGroupExampleInput" value="{{$app->test->name}}" disabled>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Extract</label>
        <select class="form-control" name="extract_id">
          @foreach($extracts as $extract)
          <option value="{{$extract->id}}" @if(isset($obj)) @if($obj->extract_id == $extract->id) selected @endif @endif >{{ $extract->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Label</label>
        <input type="text" class="form-control" name="label" id="formGroupExampleInput" placeholder="Enter the label" 
        @if($stub=='Create')
            value="{{ (old('label')) ? old('label') : '' }}"
            @else
            value = "{{ $obj->label }}"
            @endif
            >
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Prefix</label>
        <input type="text" class="form-control" name="prefix" id="formGroupExampleInput" placeholder="Enter the prefix statement" 
        @if($stub=='Create')
            value="{{ (old('prefix')) ? old('prefix') : '' }}"
            @else
            value = "{{ $obj->prefix }}"
            @endif
        >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Answer</label>
        <input type="text" class="form-control" name="answer" id="formGroupExampleInput" placeholder="Enter the answer" 
        @if($stub=='Create')
            value="{{ (old('answer')) ? old('answer') : '' }}"
            @else
            value = "{{ $obj->answer }}"
            @endif
        >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Suffix</label>
        <input type="text" class="form-control" name="suffix" id="formGroupExampleInput" placeholder="Enter the suffix statement" 
        @if($stub=='Create')
            value="{{ (old('suffix')) ? old('suffix') : '' }}"
            @else
            value = "{{ $obj->suffix }}"
            @endif
        >
      </div>
      
   

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @else
      <input type="hidden" name="sno" value="{{ $app->sno }}">  
      @endif
      
      <input type="hidden" name="test_id" value="{{ $app->test->id }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <button type="submit" class="btn btn-info">Save</button>
    </form>
    </div>
  </div>
@endsection
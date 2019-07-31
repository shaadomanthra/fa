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
      

      <div class="form-group">
        <label for="formGroupExampleInput ">Test</label>
        <input type="text" class="form-control" name="test_" id="formGroupExampleInput" value="{{$app->test->name}}" disabled>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Extract</label>
        <select class="form-control" name="extract_id">
          @foreach($extracts as $extract)
          <option value="{{$extract->id}}" @if(isset($obj)) @if($obj->extract_id == $extract->id) selected @else @if(request()->session()->get('extract_id')) @if(request()->session()->get('extract_id') == $extract->id) selected @endif @endif @endif  @endif >{{ $extract->name }}</option>
          @endforeach
        </select>
      </div>

      
      <div class="form-group">
        <label for="formGroupExampleInput ">Question</label>
        <input type="text" class="form-control" name="question" id="formGroupExampleInput" placeholder="" 
             @if($stub=='Create')
            value="{{ (old('question')) ? old('question') : '' }}"
            @else
            value="{{ $obj->question }}"
            @endif
          >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Option A</label>
        <input type="text" class="form-control" name="a" id="formGroupExampleInput" placeholder="" 
             @if($stub=='Create')
            value="{{ (old('a')) ? old('a') : '' }}"
            @else
            value="{{ $obj->a }}"
            @endif
          >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Option B</label>
        <input type="text" class="form-control" name="b" id="formGroupExampleInput" placeholder="" 
            @if($stub=='Create')
            value="{{ (old('b')) ? old('b') : '' }}"
            @else
            value="{{ $obj->b }}"
            @endif
          >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Option C</label>
        <input type="text" class="form-control" name="c" id="formGroupExampleInput" placeholder="" 
            @if($stub=='Create')
            value="{{ (old('c')) ? old('c') : '' }}"
            @else
            value="{{ $obj->c }}"
            @endif
          >
      </div>
      <div class="form-group">
        <label for="formGroupExampleInput ">Option D</label>
        <input type="text" class="form-control" name="d" id="formGroupExampleInput"  
            @if($stub=='Create')
            value="{{ (old('d')) ? old('d') : '' }}"
            @else
            value="{{ $obj->d }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Answer</label>
        <select class="form-control" name="answer">
          <option value="A" @if(isset($obj)) @if($obj->answer=='A') selected @endif @endif >A</option>
          <option value="B" @if(isset($obj)) @if($obj->answer=='B') selected @endif @endif >B</option>
          <option value="C" @if(isset($obj)) @if($obj->answer=='C') selected @endif @endif >C</option>
          <option value="D" @if(isset($obj)) @if($obj->answer=='D') selected @endif @endif >D</option>
        </select>
      </div>

       <div class="form-group">
        <label for="formGroupExampleInput">Tags</label>
         <div class=" card p-3">
          <div class="row">
          @foreach($tags as $tag)
          <div class="col-12 col-md-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="defaultCheck1" @if($obj->tags->contains($tag->id))) checked @endif>
            <label class="form-check-label" for="defaultCheck1">
              {{ $tag->name }} - {{ $tag->value }}
            </label>
          </div>
          </div>
          @endforeach
         </div>
         </div>
      </div>

      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
        <input type="hidden" name="sno" value="{{ $obj->sno }}">
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
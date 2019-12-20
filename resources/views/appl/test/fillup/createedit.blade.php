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
        <label for="formGroupExampleInput ">Qno  <span data-toggle="tooltip" title="Enter -1 for example (IELTS)" class="text-secondary"><i class="fa fa-info-circle" aria-hidden="true"></i></span></label>
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
        <label for="formGroupExampleInput ">Section</label>
        <select class="form-control" name="section_id">
          <option value="" @if(isset($obj)) @if(!$obj->section_id) selected @endif @endif >- None -</option>
          @foreach($sections as $section)
          <option value="{{$section->id}}" @if(isset($obj)) @if($obj->section_id == $section->id) selected  @endif @endif  >{{ $section->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Extract</label>
        <select class="form-control" name="extract_id">
          <option value="" @if(isset($obj)) @if(!$obj->extract_id) selected @endif @endif >- None -</option>
          @foreach($extracts as $extract)
          <option value="{{$extract->id}}" @if(isset($obj)) @if($obj->extract_id == $extract->id) selected  @endif  @endif >{{ $extract->name }}</option>
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
      <div class="form-group">
        <label for="formGroupExampleInput ">Layout </label>
        <select class="form-control" name="layout">
          <option value="" @if(isset($obj)) @if(!$obj->layout) selected @endif @endif >- None -</option>
          <option value="ielts_two_blank" @if(isset($obj)) @if($obj->layout=='ielts_two_blank') selected @endif @endif >IELTS Two Blanks</option>
          <option value="two_blank" @if(isset($obj)) @if($obj->layout=='two_blank') selected @endif @endif >Title Two Blanks</option>
          <option value="paragraph" @if(isset($obj)) @if($obj->layout=='paragraph') selected @endif @endif >Paragraph</option>

          <option value="cloze_test" @if(isset($obj)) @if($obj->layout=='cloze_test') selected @endif @endif >Cloze Test</option>
          <option value="gre_sentence" @if(isset($obj)) @if($obj->layout=='gre_sentence') selected @endif @endif >Gre Sentence</option>
          <option value="dropdown" @if(isset($obj)) @if($obj->layout=='dropdown') selected @endif @endif >Dropdown</option>
          <option value="pte_reorder" @if(isset($obj)) @if($obj->layout=='pte_reorder') selected @endif @endif >PTE Reorder</option>

        </select>
      </div>


      <div class="form-group">
        <label for="formGroupExampleInput">Tags</label>
          @foreach($tags->groupBy('name') as $name=>$t)
          <div class="border rounded p-2 mb-1 bg-light">
          <div class="row">
          <div class="col-12 col-md-2"><b>{{$name}}</b></div>
          @foreach($t as $tag)
          <div class="col-12 col-md-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="defaultCheck1" @if($obj->tags->contains($tag->id))) checked @endif>
            <label class="form-check-label" for="defaultCheck1">
               {{ $tag->value }}
            </label>
          </div>
          </div>
          @endforeach

          </div>
        </div>
          @endforeach
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
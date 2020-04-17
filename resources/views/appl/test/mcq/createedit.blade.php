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
        <label for="formGroupExampleInput ">Qno</label>
        <input type="text" class="form-control" name="qno" id="formGroupExampleInput" placeholder="Enter the Question number" 
            @if($stub=='Create')
            value="{{ (old('qno')) ? old('qno') : $app->qno }}"
            @else
            value = "{{ $obj->qno }}"
            @endif
          >
      </div>
      

      <div class="form-group">
        <label for="formGroupExampleInput ">Test</label>
        <input type="text" class="form-control" name="test_" id="formGroupExampleInput" value="{{$app->test->name}}" disabled>
      </div>

      @if(!in_array(strtolower($app->test->testtype->name),['grammar']))
      <div class="form-group">
        <label for="formGroupExampleInput ">Section</label>
        <select class="form-control" name="section_id">
          <option value="" @if(isset($obj)) @if(!$obj->section_id) selected @endif @endif >- None -</option>
          @foreach($sections as $section)
          <option value="{{$section->id}}" @if(isset($obj)) @if($obj->section_id == $section->id) selected  @endif @endif  >{{ $section->name }}</option>
          @endforeach
        </select>
      </div>
      @endif

      <div class="form-group">
        <label for="formGroupExampleInput ">
        @if(in_array(strtolower($app->test->testtype->name),['listening','reading']))
  Extract
  @else
  Passage
  @endif
      </label>
        <select class="form-control" name="extract_id">
          <option value="" @if(isset($obj)) @if(!$obj->extract_id) selected @endif @endif >- None -</option>
          @foreach($extracts as $extract)
          <option value="{{$extract->id}}" @if(isset($obj)) @if($obj->extract_id == $extract->id) selected  @endif  @endif >{{ $extract->name }}</option>
          @endforeach
        </select>
      </div>

      
      <div class="form-group">
        <label for="formGroupExampleInput ">Question</label>
        <textarea class="form-control summernote" name="question"  rows="5">
            @if($stub=='Create')
            {{ (old('question')) ? old('question') : '' }}
            @else
            {{ $obj->question }}
            @endif
        </textarea>
      </div>

      @foreach(['a','b','c','d','e','f','g','h','i'] as $opt)
      <div class="form-group">
        <label for="formGroupExampleInput ">Option {{ strtoupper($opt)}}</label>
        <textarea class="form-control summernote" name="{{$opt}}"  rows="5">
            @if($stub=='Create')
            {{ (old($opt)) ? old($opt) : '' }}
            @else
            {{ $obj->$opt }}
            @endif
        </textarea>
      </div>
      @endforeach


      <div class="form-group">
        <label for="formGroupExampleInput ">Explanation / Solution</label>
        <textarea class="form-control summernote" name="explanation"  rows="5">
            @if($stub=='Create')
            {{ (old('explanation')) ? old('explanation') : '' }}
            @else
            {{ $obj->explanation }}
            @endif
        </textarea>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput">Answers</label>
         <div class=" card p-3">
          <div class="row">
          @foreach(['a','b','c','d','e','f','g','h','i'] as $ans)
          <div class="col-12 col-md-1">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="answers[]" value="{{strtoupper($ans)}}" id="defaultCheck1" @if(strpos($obj->answer,strtoupper($ans))!==FALSE) checked @endif>
            <label class="form-check-label" for="defaultCheck1">
              {{ strtoupper($ans) }}
            </label>
          </div>
          </div>
          @endforeach
         </div>
         </div>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Layout</label>
        <select class="form-control" name="layout">
          <option value="" @if(isset($obj)) @if(!$obj->layout) selected @endif @endif >- None -</option>
          <option value="no_instruction" @if(isset($obj)) @if($obj->layout=='no_instruction') selected @endif @endif >No instruction</option>
          <option value="gre1" @if(isset($obj)) @if($obj->layout=='gre1') selected @endif @endif >Gre 1 Blank</option>
          <option value="gre2" @if(isset($obj)) @if($obj->layout=='gre2') selected @endif @endif >Gre 2 Blanks</option>
          <option value="gre3" @if(isset($obj)) @if($obj->layout=='gre3') selected @endif @endif >Gre 3 Blanks</option>
          <option value="gre_maq" @if(isset($obj)) @if($obj->layout=='gre_maq') selected @endif @endif >Gre Multi Answer</option>
          <option value="gre_numeric" @if(isset($obj)) @if($obj->layout=='gre_numeric') selected @endif @endif >Gre Numeric</option>
          <option value="gre_fraction" @if(isset($obj)) @if($obj->layout=='gre_fraction') selected @endif @endif >Gre Fraction</option>
          <option value="gre_sentence" @if(isset($obj)) @if($obj->layout=='gre_sentence') selected @endif @endif >Gre Sentence</option>
          <option value="pte_maq" @if(isset($obj)) @if($obj->layout=='pte_maq') selected @endif @endif >PTE Multi Answer</option>
          <option value="pte_mcq" @if(isset($obj)) @if($obj->layout=='pte_mcq') selected @endif @endif >PTE Single Answer</option>
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
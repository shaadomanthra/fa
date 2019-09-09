@extends('layouts.app')
@section('title', 'Writing Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)

@section('content')
<form method="post" action="{{ route('attempt.upload',$test->slug) }}" enctype="multipart/form-data">
<div class="" style="padding-left:0px;padding-right:0px;">

<div class="bg-white rounded ">
    <div class="row no-gutters">
        
        @if(!$attempt)
        <div class="col-12 ">
            <div class=" p-4  rounded mb-4 mb-md-0" style="background: #fffadd;">
              <div class="row">
                <div class="col-12 col-md-2">
                  <img src="{{  url('/').'/images/general/writing.png'}}" class="  mb-4 mx-auto d-block" style="max-width:100px;"/>
                </div>
                <div class="col-12 col-md-10">
                  @if(strlen(strip_tags($test->description))>0)
                  <div class="writing">{!!$test->description!!}</div>
                  @else
                  <h5>Enter your question</h5>
                  <textarea class="form-control summernote3" name="question" rows=4></textarea>
                  @endif
                </div>

              </div>
            
            </div>
        </div>
        @endif
        <div class="col-12 ">
          <div class="p-4 row mt-3" >

            <div class="col-12 col-md-2">
                  &nbsp;
                </div>
                <div class="col-12 col-md-10">
                   @if(!$attempt)
                @include('appl.test.attempt.blocks.write')
           @else
                @include('appl.test.attempt.blocks.writing_file')
           @endif
                </div>

         

           
           
        </div>
      </div>
        
    </div>
    </div>
</div>
</form>

@endsection

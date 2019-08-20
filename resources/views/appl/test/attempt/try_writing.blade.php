@extends('layouts.app')
@section('title', 'Writing Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)

@section('content')
<div class="" style="padding-left:0px;padding-right:0px;">

<div class="bg-white rounded ">
    <div class="row no-gutters">
        
        <div class="col-12 col-md-6 col-lg-6">
            <div class=" p-4  rounded mb-4 mb-md-0" style="background: #fffadd;height: stretch;height:100%;">
            <div class="writing">{!!$test->description!!}</div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
          <div class="p-4" >
            <div class="">
           <img src="{{  url('/').'/images/general/writing.png'}}" class="  mb-4 mx-auto d-block" style="max-width:100px;"/>
         </div>
      
           <h3 class="mb-5 text-center">Writing Task</h3>

          @if(!$attempt)
                @include('appl.test.attempt.blocks.write')
           @else
                @include('appl.test.attempt.blocks.writing_file')
           @endif

           @if(!$attempt)
              @include('appl.test.attempt.blocks.premium_writing')
           @else
            @if(!$attempt->answer)
              @include('appl.test.attempt.blocks.premium_writing')
            @endif
           @endif
        </div>
      </div>
        
    </div>
    </div>
</div>

@endsection

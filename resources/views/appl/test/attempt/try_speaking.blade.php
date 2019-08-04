@extends('layouts.app')
@section('content')
@include('flash::message')
<div class="" style="padding-left:0px;padding-right:0px;">

<div class="bg-white rounded ">
    <div class="row">
        
        <div class="col-12 col-md-7 col-lg-8">
            <div class=" p-5  rounded mb-4 mb-md-0" style="background: #FFF5EB;height: stretch;height:100%;">
            <div class="speaking">{!!$test->description!!}</div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-4">
        <div class="pr-4 pl-4 pl-md-0 pb-4">
           <img src="{{  url('/').'/images/general/speaking.png'}}" class=" mt-4 mb-4 mx-auto d-block" style="max-width:100px;"/>
      
           <h3 class="mb-5 text-center">Speaking Task</h3>

           @if(!$attempt)
                @include('appl.test.attempt.blocks.audio_upload')
           @else
                @include('appl.test.attempt.blocks.speaking_audio')
           @endif

           @if(!$attempt)
              @include('appl.test.attempt.blocks.premium_speaking')
           @else
            @if(!$attempt->answer)
              @include('appl.test.attempt.blocks.premium_speaking')
            @endif
           @endif
        </div>
        </div>
    </div>
    </div>
</div>

@endsection

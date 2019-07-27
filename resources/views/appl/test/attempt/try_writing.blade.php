@extends('layouts.app')
@section('content')
<div class="container" style="padding-left:0px;padding-right:0px;">

<div class="bg-white rounded ">
    <div class="row">
        
        <div class="col-12 col-md-8">
            <div class=" p-4  rounded mb-4 mb-md-0" style="background: #fffadd;">
            {!!$test->description!!}
            </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="pr-4">
           <img src="{{  url('/').'/uploads/'.$test->tags->first()->image}}" class=" mt-4 mb-4 mx-auto d-block" style="max-width:100px;"/>
      
           <h3 class="mb-5 text-center">Writing Task</h3>

          @if(!$attempt)
                @include('appl.test.attempt.blocks.file_upload')
           @else
                @include('appl.test.attempt.blocks.writing_file')
           @endif

           @include('appl.test.attempt.blocks.premium')
        </div>
      </div>
        
    </div>
    </div>
</div>

@endsection

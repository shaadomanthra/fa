@extends('layouts.duolingo')
@section('title', 'Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')

@guest
<div class="alert alert-warning alert-dismissible alert-important fade show" role="alert">
  <strong>Note:</strong> Only registered users can submit the test and view the result. 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endguest


<div class="container " style="padding-left:0px;padding-right:0px;max-width:900px;">
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  
   @if(isset($view))
            <input type="hidden" name="admin" value="1">
            @endif

    @include('appl.test.attempt.blocks.screen_duolingo')
    @include('appl.test.attempt.blocks.gremodal')
    </form>
</div>
@endsection

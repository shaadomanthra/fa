@extends('layouts.duolingo')
@section('title', 'Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')





<div class="container {{$p=1}}" style="padding-left:0px;padding-right:0px;max-width:900px;">

  @guest
  <div class="alert alert-warning alert-dismissible alert-important fade show mt-4" role="alert">
    <strong>Note:</strong> Only registered users can attempt this test. Kindly login. 
    <a href="{{ route('login')}}" class="float-md-right">
      Login now
    </a>
  </div>
  @else
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  
   @if(isset($view))
            <input type="hidden" name="admin" value="1">
            @endif

    @include('appl.test.attempt.blocks.screen_duolingo')
    @include('appl.test.attempt.blocks.gremodal')
    </form>
  @endguest
    
</div>
@endsection

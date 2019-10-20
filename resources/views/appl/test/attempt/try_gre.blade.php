@extends('layouts.gre')
@section('title', 'Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')
<div class="container " style="padding-left:0px;padding-right:0px;">
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  
   @if(isset($view))
            <input type="hidden" name="admin" value="1">
            @endif
            
    @include('appl.test.attempt.blocks.screen_gre')
    @include('appl.test.attempt.blocks.gremodal')
    </form>
</div>
@endsection

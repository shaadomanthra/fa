@extends('layouts.app')
@section('title', 'Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')
<div class="container" style="padding-left:0px;padding-right:0px;">
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  
    <div class="row">
        <div class="col-12 ">
            @foreach($test->sections as $s=>$section)
                @include('appl.test.attempt.blocks.screen_gre')
            @endforeach
        </div>
        
    </div>
    @include('appl.test.attempt.blocks.gremodal')
    </form>
</div>
@endsection

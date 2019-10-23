@extends('layouts.reading')
@section('title', 'Reading Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')
<div class="" style="padding-left:0px;padding-right:0px;">
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  

        <div class="row no-gutters">
            <div class="col-12 col-md-6 ">
                <div class="panel leftpanel p-4 {{$sno=1}}">
                    <div class="0"></div>
                    @foreach($test->sections as $s=>$section)
                    @include('appl.test.attempt.blocks.section_reading_text')
                    @endforeach
                    <br><br>

                </div>

            </div>
            <div class="col-12 col-md-6 ">
                <div id="a" class="panel rightpanel p-4 {{$sno}}" >
                    <div id="c" class="content"> 
                    <div id="0"></div>
                    @foreach($test->sections as $s=>$section)
                    @include('appl.test.attempt.blocks.section_reading_ques')
                    @endforeach
                    <br><br><br>
                    </div>
                </div>

            </div>
        </div>

        @if(isset($view))
        <input type="hidden" name="admin" value="1">
        @endif
        <input type="hidden" name="test_id" value="{{ $app->test->id }}">
        <input type="hidden" name="user_id" value="@if(\auth::user())
            {{ \auth::user()->id }}
            @endif
            ">
        <input type="hidden" name="product" value="@if($product){{ $product->slug }} @endif">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('appl.test.attempt.blocks.qno_reading')

        

        @include('appl.test.attempt.blocks.modal')
    </form>
</div>

@endsection

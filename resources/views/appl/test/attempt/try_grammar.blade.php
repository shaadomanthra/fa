@extends('layouts.app')
@section('title', 'Grammar Test - '.$test->name)
@section('description', 'The Test page of '.$test->name)
@section('keywords', 'practice tests, '.$test->name)
@section('content')
<div class="container" style="padding-left:0px;padding-right:0px;">
    <form id="test" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post">  

    <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            
            <div class="mb-3">
                <div class="part">
                <h3><i class="fa fa-clone"></i> {{ $test->name}}</h3>
                @if(strip_tags($test->description))
                <p>{!! $test->description !!}</p>
                @endif
                </div>
                <div class="bg-white border-top p-4">
                @if(count($test->mcq_order)!=0)
                    @include('appl.test.attempt.blocks.mcq_grammar')
                @endif

                @if(count($test->fillup_order)!=0)
                    @include('appl.test.attempt.blocks.fillup_grammar')
                @endif
                </div>
            </div>

        </div>
        <div class="col-12 col-md-4 col-lg-4">
            <input type="hidden" name="test_id" value="{{ $app->test->id }}">
            <input type="hidden" name="user_id" value="{{ \auth::user()->id }}">
            <input type="hidden" name="product" value="@if($product){{ $product->slug }} @endif">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('appl.test.attempt.blocks.qno')
        </div>
        
    </div>
    @include('appl.test.attempt.blocks.modal')
    </form>
</div>

@endsection

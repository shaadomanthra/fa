@extends('layouts.app')
@section('content')
<div class="container" style="padding-left:0px;padding-right:0px;">
    <form id="test" class="test" action="{{route($app->module.'.store',$app->test->slug)}}" method="post">  

    <div class="row">
        <div class="col-12 col-md-8">
           
            @if(file_exists(public_path().'/uploads/'.$test->file) && $test->file)
                @include('appl.test.attempt.blocks.audio')
            @endif
            
            @foreach($test->sections as $s=>$section)
                @include('appl.test.attempt.blocks.section')
            @endforeach

        </div>
        <div class="col-12 col-md-4">
            <input type="hidden" name="test_id" value="{{ $app->test->id }}">
            <input type="hidden" name="user_id" value="{{ \auth::user()->id }}">
             <input type="hidden" name="product" value="{{ $product->slug }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('appl.test.attempt.blocks.qno')
        </div>
        
    </div>
    @include('appl.test.attempt.blocks.modal')
    </form>
</div>

@endsection

@extends('layouts.app')
@section('title', $test->name.' - Report')
@section('description', 'Result page of Test')
@section('keywords', 'result page of test, first academy')
@section('content')

@if($test->category->slug=='gre')
  @include('appl.test.attempt.alerts.gre_result')
@else
<div class="">
  <div class="row">
    <div class="col-12">
      <div class="bg-white p-4 border">
        <div class="row">
          <div class="col-12 col-md-6">
            <h3 class="text-center text-md-left mb-md-4 mt-2  p-4">
              <i class="fa fa-bar-chart"></i> {{ $test->name}} - Report
              
              <br>
              @if(isset($admin))
              <a href="{{ route('test.show',$test->id)}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Test</button>
              </a>
              
              @elseif(request()->get('product'))
              <a href="{{ route('product.view',request()->get('product'))}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Product</button>
              </a>
              @else
              <a href="{{ route('test',$test->slug)}}">
                <button class="btn btn-sm btn-outline-primary mt-3 ">
                  <i class="fa fa-angle-left"></i> back to Test</button>
              </a>
              @endif
            </h3>
          </div>
          <div class="col-12 col-md-6">
             <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded ">
              <div class="">Score</div>
              <div class="display-4">{{ $score }} / {{ $test->marks}} </div>
            </div>
            @if($band)
            <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded mr-0 mr-md-4">
              <div class="">&nbsp;&nbsp;&nbsp; Band &nbsp;&nbsp;&nbsp;</div>
              <div class="display-4">{{ $band }} </div>
            </div>
            @elseif($points)
            <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded mr-0 mr-md-4">
              <div class="">&nbsp;&nbsp;&nbsp; Points &nbsp;&nbsp;&nbsp;</div>
              <div class="display-4">{{ $points }} </div>
            </div>
            @endif
          </div>
        </div>

        @include('appl.test.attempt.blocks.answers')
        

      </div>

      @if(isset($tags))
      @if($tags)
      <div class="mt-4 ">
        @include('appl.test.attempt.alerts.tags')
      </div>
      @endif
      @endif
    </div>
  </div>
</div>
@endif
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="bg-light p-4">
            <h3 class="text-center text-md-left mb-4 mt-2  p-4"><i class="fa fa-bar-chart"></i> Test Report
              <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right">
                    <div class="mt-4 mt-md-0">Your Score</div>
                  <div class="display-2 mb-4">{{ $score }} </div>
                </div>
              <br>
              <a href="{{ route('product.view',request()->get('product'))}}">
              <button class="btn btn-sm btn-outline-primary mt-md-3 "><i class="fa fa-angle-left"></i> back to Product</button>
              </a>
                
            </h3>


           @include('appl.test.attempt.blocks.answers')
          </div>
        </div>
    </div>
</div>
@endsection

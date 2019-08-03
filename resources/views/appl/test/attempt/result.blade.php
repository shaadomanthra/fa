@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="bg-white p-4">
            <div class="row">
              <div class="col-12 col-md-6">
                <h3 class="text-center text-md-left mb-md-4 mt-2  p-4"><i class="fa fa-bar-chart"></i> Test Report
              
              <br>
              <a href="{{ route('product.view',request()->get('product'))}}">
              <button class="btn btn-sm btn-outline-primary mt-3 "><i class="fa fa-angle-left"></i> back to Product</button>
              </a>
                
            </h3>
              </div>
              <div class="col-12 col-md-6">
                <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right border bg-light p-3 rounded">
                    <div class="">Score</div>
                  <div class="display-4">{{ $score }} / {{count($result)}} </div>
                </div>
                <div class="text-center  mt-3 mb-3 mt-md-0 mb-md-0 float-md-right mr-md-4 border bg-light p-3 rounded">
                    <div class="">Band</div>
                  <div class="display-4 pr-3 pl-3 text-primary">{{ $band }} </div>
                </div>
              </div>
            </div>
            

           @include('appl.test.attempt.blocks.answers')
          </div>
        </div>
    </div>
</div>
@endsection

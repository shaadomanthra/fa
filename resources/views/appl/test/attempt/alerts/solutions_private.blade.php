@extends('layouts.clean')
@section('title', $test->name.' - Report')
@section('description', 'Result page of Test')
@section('keywords', 'result page of test, first academy')
@section('content')


<div class="container mt-4">
      <div class="bg-white p-4 border">
        <div class="row">
          <div class="col-12 col-md-6">
            <h3 class="text-center text-md-left mb-md-4 mt-2  p-4">
              <i class="fa fa-bar-chart"></i> {{ $test->name}} - Report
            </h3>

          </div>
          
        </div>

        
      <div class="alert alert-important alert-success mt-4 p-md-4">
        <h3><i class="fa fa-thumbs-up"></i> Successfully completed the test. </h3>
        <p class="mb-0"> The responses are recorded for internal evaluations</p>
        
      </div>

        

      </div>

      
    </div>
  </div>
</div>

@endsection

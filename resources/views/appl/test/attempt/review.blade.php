@extends('layouts.app')
@section('content')
<div  class="row ">
  <div class="col-md-12">
    <div class="bg-white rounded border p-4 mb-3">
    <div class="row">
      <div class="col-12 col-md-2">
        <img src="{{ asset('images/general/review.png') }}" class="w-100" />
      </div>
      <div class="col-12 col-md-10">
        <div class="pl-md-3 pt-md-3">
        <h2>Expert Review</h2>
        Test Name : {{ $test->name }} <br>
        User : {{ \auth::user()->name }}
      </div>
      </div>
    </div>
    </div>
    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <div class="mb-3">
        {!! $attempt->answer !!}
        </div>
        
     </div>
   </div>
 </div>
</div>
@endsection



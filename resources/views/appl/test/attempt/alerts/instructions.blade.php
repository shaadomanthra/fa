@extends('layouts.app')
@section('title', 'Test Instructions - '.$test->name)
@section('description', 'These are the test instructions of the test '.$test->name)
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')

@section('content')
<div  class="row ">
  <div class="col-md-12">
    <div class=" bg-light p-3 border mb-3 " style="word-wrap: break-word;
    "><div class="h4 mt-2" style="word-wrap: break-word;
    "><i class="fa fa-bars"></i> {{ $test->name }} - Instructions </div> 
  </div>
  <div class="card">
    <div class="card-body mb-0">
      <div class="mb-4 mb-md-0 float-md-right text-md-right">
        <img class=" " src="{{ asset('images/general/instructions.png') }}" alt="" style="width:100px" >
      </div>
      <div class="mb-3 " style="font-size: 18px;">
        {!! $test->instructions !!}
      </div>
      <a href="{{ route('test.try',$test->slug)}}?product={{$product->slug}}">
        <button class="btn btn-primary btn-lg"> Start Test</button>
      </a>
    </div>
  </div>
</div>
</div>
@endsection



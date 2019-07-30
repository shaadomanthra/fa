@extends('layouts.app')
@section('content')
<div  class="row ">
  <div class="col-md-12">
    <nav class="navbar navbar-light bg-light justify-content-between border mb-3 ">
    <a class="navbar-brand"><h3 class="mt-2"><i class="fa fa-bars"></i> {{ $test->name }} - Instructions </h3></a>  
    </nav>

    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <div class="mb-3">
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



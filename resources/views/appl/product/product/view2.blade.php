@extends('layouts.breadcrumb')

@section('title',$obj->name.' - First Academy' )
@section('description', strip_tags($obj->description))
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET, '.$obj->name)

@section('content')
<div class="p-4 " style="background:#eee;">
  @include('appl.product.product.blocks.header')
</div>

<div class="bg-white">
<main class="py-4 container ">

@if(count($obj->tests)!=0)
  <div class="row ">
    <div class="col-12 col-md-3">
      @include('appl.product.product.blocks.sideblock')
    </div>

    <div class="col-12 col-md-9">
        @include('appl.product.product.blocks.tests')

        @if(count($obj->tests)>3)
          
          @include('appl.product.product.blocks.viewmore')
         
          @include('appl.product.product.blocks.why_these_tests')

          @include('appl.product.product.blocks.details')

          @include('appl.product.product.blocks.related')
  
        @endif

    </div>
  </div>
@else

@include('appl.product.product.blocks.sideblock')

@endif
</main>
</div>
@endsection
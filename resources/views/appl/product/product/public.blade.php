@extends('layouts.breadcrumb')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Assess your level completely free. Free full-length tests for OET and IELTS and tests on vocabulary resources')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
@include('flash::message')
<div  class=" ">
  <div class="">
    <div class="" style="background: #eee">
    @include('appl.product.product.blocks.header_products')
    </div>

    
    <div class="bg-white">
      <div class="container pt-4">
        <div id="search-items" class="row ">
         @include('appl.'.$app->app.'.'.$app->module.'.public_list')
       </div>
       <br>

     </div>
   </div>
 </div>
</div>
@endsection



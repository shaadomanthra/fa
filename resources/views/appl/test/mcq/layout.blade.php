@extends('layouts.bg')
@section('title', 'MCQ Layouts | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('content')

<div class="container">
  @include('flash::message')
  <div class="my-4 bg-white p-4">
    <h1 class="display-4  bborder mb-5" >Create MCQ</h1>
  <div class="row">
    
    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/default.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Default Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre2">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre2.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">2 Column 6 Options Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre3">
      <div class="item border  bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre3.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">3 Column 9 Options Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre_maq">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre_maq.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Multi Answer Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre_numeric">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre_numeric.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Numeric Entry Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre_fraction">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre_fraction.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Fraction Format</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('mcq.create',$app->test->id)}}?layout=gre_sentence">
      <div class="item border bg-light mb-4">
        <img src="{{ asset('images/tests/mcq/gre_sentence.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Sentence Selection</h5>
      </div>
      </div>
    </a>
    </div>



   
  </div>
</div>
   
     
</div>




@endsection
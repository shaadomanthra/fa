@extends('layouts.bg')
@section('title', 'Fillup Layouts | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('content')







<div class="container">
  @include('flash::message')
  <div class="my-4 bg-white p-4">
    <h1 class="display-4  bborder mb-5" >Create Fillup</h1>
  <div class="row">
    
    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/default_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Default Layout</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=ielts_number">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/ielts_number_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Numbered Blank</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=ielts_label">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/ielts_label_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Label Column</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=ielts_two_blank">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/ielts_two_blank_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Two Blanks - Format 1</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=two_blank">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/two_blank_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Two Blanks - Format 2</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=paragraph">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/paragraph_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Paragraph</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=cloze_test">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/cloze_test_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Dropdown - Format 1</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=dropdown">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/dropdown_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Dropdown - Format 2</h5>
      </div>
      </div>
    </a>
    </div>

    <div class="col-12 col-md-4">
      <a href="{{ route('fillup.create',$app->test->id)}}?layout=duolingo_missing_letter">
      <div class="item border mb-4">
        <img src="{{ asset('images/tests/fillup/duolingo_missing_letter_layout.png')}}" class="w-100">
        <div class="p-2">
        <h5 class="mt-2 ml-2">Missing Letters</h5>
      </div>
      </div>
    </a>
    </div>


   
  </div>
</div>
   
     
</div>




@endsection
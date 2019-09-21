@extends('layouts.app')
@section('title', 'Form | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

@include('flash::message')
<div class="row">
  <div class="col-12 col-md-9">
  <div class="card">
    <div class="card-body">
      <h1 class="p-3 border bg-light mb-3">
        Request Form @if(request()->get('test')) - FREE Test @elseif(request()->get('counselling')) - FREE Counselling @endif
       </h1>
      
      @if($stub=='Create')
      <form method="post" action="{{route('form.save')}}" enctype="multipart/form-data">
      @else
      <form method="post" action="{{route($app->module.'.update',$obj->id)}}" enctype="multipart/form-data">
      @endif  
      <div class="form-group">
        <label for="formGroupExampleInput ">Name</label>
        <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter your Name" 
            @if($stub=='Create')
            value="{{ (old('name')) ? old('name') : '' }}"
            @else
            value = "{{ $obj->name }}"
            @endif
          >
      </div>
      
      <div class="form-group">
        <label for="formGroupExampleInput ">Email</label>
        <input type="email" class="form-control" name="email" id="formGroupExampleInput" placeholder="Enter you email address" 
            @if($stub=='Create')
            value="{{ (old('email')) ? old('email') : '' }}"
            @else
            value = "{{ $obj->email }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Phone number</label>
        <input type="number" class="form-control" name="phone" id="formGroupExampleInput" placeholder="Enter your phone number (10 digits)" 
            @if($stub=='Create')
            value="{{ (old('phone')) ? old('phone') : '' }}"
            @else
            value = "{{ $obj->phone }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">College (optional)</label>
        <input type="text" class="form-control" name="college" id="formGroupExampleInput" placeholder="Enter your college name" 
            @if($stub=='Create')
            value="{{ (old('college')) ? old('college') : '' }}"
            @else
            value = "{{ $obj->college }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Year of passing (optional)</label>
        <input type="text" class="form-control" name="year" id="formGroupExampleInput" placeholder="Enter the year of passing" 
            @if($stub=='Create')
            value="{{ (old('year')) ? old('year') : '' }}"
            @else
            value = "{{ $obj->year }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Subject</label>
        <input type="text" class="form-control" name="subject" id="formGroupExampleInput" placeholder="Enter subject" 
            @if($stub=='Create')
              @if(request()->get('test')) value="Request for FREE GRE & IELTS Test"
              @elseif(request()->get('counselling')) value= "Request for FREE Counselling" 
              @endif
            @else
            value = "{{ $obj->subject }}"
            @endif
          >
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput ">Description (optional)</label><br>
        <small class="text-secondary">Enter the extra details you want to let us know.</small>
         <textarea class="form-control " name="description"  rows="3">@if($stub=='Create'){{ (old('description')) ? old('description') : '' }}@else{{ $obj->description }}@endif</textarea>

      </div>


      @if($stub=='Update')
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $obj->id }}">
      @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-primary btn-lg">Save</button>
    </form>
    </div>
  </div>
</div>
<div class="col-12 col-md-3">
  <div class="h3 p-3 border bg-light mb-3"><i class="fa fa-gg"></i> Free Tests</div>
  @if(isset($tests))
  @foreach($tests as $test)
    @include('appl.pages.blocks.test')
  @endforeach
  @endif
</div>
</div>
@endsection
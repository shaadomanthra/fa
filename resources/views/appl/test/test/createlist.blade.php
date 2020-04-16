@extends('layouts.bg')
@section('title', 'IELTS')
@section('content')
<div class="container">
<div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
  <h1 class="display-4 mb-3 mb-md-5 bborder " >Create Test</h1>

  <div class="row">

  	<div class="col-12 col-md-6">
  		<div class="p-4 bg-white">
  			<div class="row">
  				<div class="col-3">
  					<img src="{{ asset('images/tests/listening.png')}}" class="w-100">
  				</div>
  				<div class="col-9">
  					<div><h3 class="bborder mb-4">IELTS </h3></div>
  					<a href="{{ route('test.create')}}?category=ielts&type=listening" class="btn btn-outline-primary btn-lg mb-3 mr-2">Listening</a> 
  					<a href="{{ route('test.create')}}?category=ielts&type=reading" class="btn btn-outline-primary btn-lg mb-3 mr-2">Reading</a>
  					<a href="{{ route('test.create')}}?category=ielts&type=writing" class="btn btn-outline-primary btn-lg mb-3 mr-2">Writing</a>
  					<a href="{{ route('test.create')}}?category=ielts&type=speaking" class="btn btn-outline-primary btn-lg mb-3 mr-2">Speaking</a>
  				</div>
  			</div>
  		</div>
  	</div>

  </div>
</div>

</div>
@endsection
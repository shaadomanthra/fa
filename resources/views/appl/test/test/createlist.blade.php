@extends('layouts.bg')
@section('title', 'IELTS')
@section('content')
<div class="container">
<div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
  <h1 class="display-4 mb-3 bborder " >Create Test</h1>
  <h5 class="mb-3 mb-md-5">Various test presets are included in the following page. These presets are necessary to have different layouts specific to the test type.</h5>
  <div class="row">

  	<div class="col-12 col-md-6">
  		<div class="p-4 bg-white mb-4">
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

  	<div class="col-12 col-md-6">
  		<div class="p-4 bg-white mb-4">
  			<div class="row">
  				<div class="col-3">
  					<img src="{{ asset('images/tests/oet.png')}}" class="w-100">
  				</div>
  				<div class="col-9">
  					<div><h3 class="bborder mb-4">OET </h3></div>
  					<a href="{{ route('test.create')}}?category=oet&type=listening" class="btn btn-outline-primary btn-lg mb-3 mr-2">Listening</a> 
  					<a href="{{ route('test.create')}}?category=oet&type=reading" class="btn btn-outline-primary btn-lg mb-3 mr-2">Reading</a>
  					<a href="{{ route('test.create')}}?category=oet&type=writing" class="btn btn-outline-primary btn-lg mb-3 mr-2">Writing</a>
  					<a href="{{ route('test.create')}}?category=oet&type=speaking" class="btn btn-outline-primary btn-lg mb-3 mr-2">Speaking</a>
  				</div>
  			</div>
  		</div>  		
  	</div>

  	<div class="col-12 col-md-6">
  		<div class="p-4 bg-white mb-4">
  			<div class="row">
  				<div class="col-3">
  					<img src="{{ asset('images/tests/tag.png')}}" class="w-100">
  				</div>
  				<div class="col-9">
  					<div><h3 class="bborder mb-4">PTE </h3></div>
  					<a href="{{ route('test.create')}}?category=pte&type=listening" class="btn btn-outline-primary btn-lg mb-3 mr-2">Listening</a> 
  					<a href="{{ route('test.create')}}?category=pte&type=reading" class="btn btn-outline-primary btn-lg mb-3 mr-2">Reading</a>
  					<a href="{{ route('test.create')}}?category=pte&type=writing" class="btn btn-outline-primary btn-lg mb-3 mr-2">Writing</a>
  					<a href="{{ route('test.create')}}?category=pte&type=speaking" class="btn btn-outline-primary btn-lg mb-3 mr-2">Speaking</a>
  				</div>
  			</div>
  		</div>  		
  	</div>

  	<div class="col-12 col-md-6">
  		<div class="p-4 bg-white mb-4">
  			<div class="row">
  				<div class="col-3">
  					<img src="{{ asset('images/tests/group.png')}}" class="w-100">
  				</div>
  				<div class="col-9">
  					<div><h3 class="bborder mb-4">Other </h3></div>
  					<a href="{{ route('test.create')}}?category=duolingo&type=DUOLINGO" class="btn btn-outline-primary btn-lg mb-3 mr-2">Duolingo</a>
  					<a href="{{ route('test.create')}}?category=general&type=grammar" class="btn btn-outline-primary btn-lg mb-3 mr-2">Simple Test - Grammar</a>
  					<a href="{{ route('test.create')}}?category=general&type=english" class="btn btn-outline-primary btn-lg mb-3 mr-2">Sectional Test - English</a>
  					 
  					<a href="{{ route('test.create')}}?category=gre&type=gre" class="btn btn-outline-primary btn-lg mb-3 mr-2">GRE</a>
  					<a href="{{ route('test.create')}}" class="btn btn-outline-primary btn-lg mb-3 mr-2">Generic (No preset)</a>
  				</div>
  			</div>
  		</div>  		
  	</div>

  </div>
</div>

</div>
@endsection
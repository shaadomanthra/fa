@extends('layouts.app')

@section('content')

@include('flash::message')
<div class="p-3 mb-3 bg-white border">
			    <div class="">
		<h3 class="mb-0">Edit Code Fragments</h3>
	</div>
</div>
      <div class="row">
      	<div class="col-6 col-md-2">
      		<div class="card">
      			<a href="{{ route('editor.page')}}?filename=../resources/views/layouts/menu.blade.php">
			    <div class="card-body text-center">
			    	<img src="{{ asset('images/admin/menu.png')}}" class="w-25 mb-3 text-center">
			    	<h5>Menubar</h5>
			    </div>
			</a>
			</div>
      	</div>
      	<div class="col-6 col-md-2">
      		<div class="card">
      			<a href="{{ route('editor.page')}}?filename=../resources/views/layouts/footer.blade.php">
			    <div class="card-body text-center">
			    	<img src="{{ asset('images/admin/footer.png')}}" class="w-25 mb-3 text-center">
			    	<h5>Footer</h5>
			    </div>
			</a>
			</div>
      	</div>
      </div>

@endsection
@extends('layouts.app')
@section('title', 'Invalid File Type - '.$test->name)
@section('description', 'Error page to show the file upload is not supported.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
<div class="bg-white">
	<div class="card-body p-4 ">
		<h1 class="text-danger"><i class="fa fa-times-circle"></i> Invalid file type</h1>
		<hr>

		<p>  The following file type (<b>{{$extension}}</b>) is not supported. <hr>Kindly contact the adminstrator for further quieries.</p>
		<a href="{{ url()->previous() }}">
			<button class="btn btn-outline-primary btn-sm"> Back</button>
		</a>
	</div>
</div>
@endsection
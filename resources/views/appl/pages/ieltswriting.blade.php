
@extends('layouts.app')
@section('title', 'IELTS Writing | First Academy')
@section('content')


<div class="bg-white">
<div class="card-body p-5 mb-4">

@include('appl.pages.blocks.write')
</div>
</div>

<div class="row">
	<div class="col-12 col-md-3">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Language Quizzes</h5>
			</div>
			<div class="card-body">
				Want to improve your writing, while at the same time get a better score in reading comprehension?<br>
				<a href="https://prep.firstacademy.in/products/language-quizzes" class="btn btn-primary mt-3 "><i class="fa fa-rocket"></i> Try Now</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Expert Evaluation</h5>
			</div>
			<div class="card-body">
				Examiner-grade writing assessments that help you understand how IELTS writing is assessed. Get a detailed breakdown of the writing scores based on the Band Descriptors.<br>
				<a href="https://prep.firstacademy.in/products/writing-general" class="btn btn-success mt-3 "><i class="fa fa-edit"></i> General</a>
				<a href="https://prep.firstacademy.in/products/writing-academic" class="btn btn-warning mt-3 "><i class="fa fa-edit"></i> Academic</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Group Class</h5>
			</div>
			<div class="card-body">
				<br>
				<a href="#" class="btn btn-secondary mt-3 "><i class="fa fa-edit"></i> Know more</a>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Personalised Session</h5>
			</div>
			<div class="card-body">
				<br>
				<a href="#" class="btn btn-secondary mt-3 "><i class="fa fa-edit"></i> Know more</a>
			</div>
		</div>
	</div>


</div>
@endsection

@extends('layouts.app')
@section('title', 'MCQ layouts | First Academy')
@section('content')


<div class="bg-white">
<div class="card-body p-4 p-md-5 ">
<div class="h1  mb-4 text-center"><u>MCQ - Layouts</u></div><br>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> Default </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/default.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5">The image showcases how the mcq would look like in the 'default' layout. You can enter upto 6 options, and empty options will not be displayed. </div>
		</div>
	</div>
</div>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> 2 columns 6 Options </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/gre2.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5">The layout would appear as in the image on the left side.</div>
		</div>
	</div>
</div>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> 3 Columns 9 Options </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/gre3.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5">The layout would appear as in the image on the left side.</div>
		</div>
	</div>
</div>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> Numeric Entry </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/gre_numeric.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5">The layout would appear as in the image on the left side.</div>
		</div>
	</div>
</div>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> Fraction </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/gre_fraction.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5">The layout would appear as in the image on the left side.</div>
		</div>
	</div>
</div>

<div class="item mb-5">
	<h3 class="text-primary mb-4"><i class="fa fa-bars"></i> Sentence Selection </h3>
	<div class="row">
		<div class="col-12 col-md-8">
			<img src="{{ asset('images/tests/mcq/gre_selection.png')}}" class="w-100 border p-3"/>
		</div>
		<div class="col-12 col-md-4">
			<h5>Details</h5>
			<div class="h5 text-info" style="line-height: 1.5"><p>For this layout to work, create the passage first then connect the passage to question.</p>
				<p>Incase if you edit the passage, it would disconnect the question & passage so after updating the passage edit the question and connect it once again with passage and save it.</p></div>
		</div>
	</div>
</div>


</div>		
</div>
@endsection           
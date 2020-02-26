

<div class="rounded p-4 mb-4" style="">
	@if($attempt->answer)
	<div class="alert alert-warning alert-important mb-4 border border-warning">
	<p>Your Evaluation Is Ready!  </p>
	<a href="{{ route('test.review',$test->slug)}}?product=@if($product){{$product->slug}}@endif">
	<button type="button" class="btn btn-bg btn-success">View Expert Review</button>
	</a>
	</div>
	@else
	<div class="alert alert-warning alert-important mb-4 border border-warning" role="alert">
  	Your writing task has been submitted. Please check back later for the evaluation. Good Luck! 
	</div>
	
	@endif
	

	<h4 class="mb-3 text-primary">Your Response </h4>
	<div class="bg-light border rounded p-3 mb-3">
	{!! $attempt->response !!}
	</div>
	
	
</div>
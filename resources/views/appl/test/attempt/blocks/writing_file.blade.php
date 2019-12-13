<div class="rounded p-4 mb-4" style="">
	<h4 class="mb-3 text-primary">Your Response </h4>
	<div class="bg-light border rounded p-3 mb-3">
	{!! $attempt->response !!}
</div>
	
	@if($attempt->answer)
	<div class="bg-light border p-3 rounded">
	<p>Your  writing task is evaluated.  </p>
	<a href="{{ route('test.review',$test->slug)}}?product=@if($product){{$product->slug}}@endif">
	<button type="button" class="btn btn-bg btn-success">Expert Review</button>
	</a>
	</div>
	@else
	<p>Good job ! Your  Writing task is submitted. Get it evaluated. </p>
	<a href="{{ route('product.view','writing-evaluation')}}">
	<button type="button" class="btn btn-sm btn-outline-primary">Expert Evaluation</button>
	</a>
	@endif
</div>
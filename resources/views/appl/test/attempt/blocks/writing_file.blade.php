<div class="rounded p-4 mb-4" style="border: 1px solid silver">
	<h4 class="mb-3 text-primary">Your Response </h4>
	<div class="bg-light border rounded p-3 mb-3">
	{!! $attempt->response !!}
</div>
	<p>Good job ! Your  Writing task is submitted. Get it evaluated. </p>
	@if($attempt->answer)
	<a href="{{ route('test.review',$test->slug)}}?product={{$product->slug}}">
	<button class="btn btn-sm btn-success">Expert Review</button>
	</a>
	@else
	<a href="{{ route('product.view','writing-evaluation')}}">
	<button class="btn btn-sm btn-outline-primary">Expert Evaluation</button>
	</a>
	@endif
</div>
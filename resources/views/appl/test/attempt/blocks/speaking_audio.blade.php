<div class="rounded p-4 mb-4" style="border: 1px solid silver">
	<h4 class="mb-3 text-primary">Your Audio File <a href="{{ route('attempt.delete',$test->slug)}}?product={{$product->slug}}"><span class="float-right"><i class="fa fa-trash" alt="Delete"></i></span></a></h4>
	<div class="border mb-4">
		<audio >
		<source id="player"  src="{{ url('/').'/storage/'.$attempt->response }}" type="audio/mp3">
		</audio>
	</div>
	<p>Good job ! Your  audio track is uploaded. Get it evaluated. </p>
	@if($attempt->answer)
	<a href="{{ route('test.review',$test->slug)}}?product={{$product->slug}}">
	<button class="btn btn-sm btn-success">Expert Review</button>
	</a>
	@else
	<a href="{{ route('product.view','speaking-evaluation')}}">
	<button class="btn btn-sm btn-outline-primary">Expert Evaluation</button>
	</a>
	@endif
</div>
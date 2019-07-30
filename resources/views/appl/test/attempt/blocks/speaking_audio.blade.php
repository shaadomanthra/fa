<div class="rounded p-4 mb-4" style="border: 1px solid silver">
	<h4 class="mb-3 text-primary">Your Audio File <a href="{{ route('attempt.delete',$test->slug)}}?product={{$product->slug}}"><span class="float-right"><i class="fa fa-trash" alt="Delete"></i></span></a></h4>
	<div class="border mb-4">
		<audio >
		<source id="player"  src="{{ url('/').'/uploads/'.$attempt->response }}" type="audio/mp3">
		</audio>
	</div>
	<p>The smart always work on their mistakes. Take a step to get your response evaluated by our team.</p>
	<a href="{{ route('pricing')}}">
	<button class="btn btn-sm btn-outline-primary">Choose a Plan</button>
	</a>
</div>
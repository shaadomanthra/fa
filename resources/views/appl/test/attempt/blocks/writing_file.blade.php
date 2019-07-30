<div class="rounded p-4 mb-4" style="border: 1px solid silver">
	<h4 class="mb-3 text-primary">Your File <a href="{{ route('attempt.delete',$test->slug)}}?product={{$product->slug}}"><span class="float-right"><i class="fa fa-trash" alt="Delete"></i></span></a></h4>
	<div class="border mb-4 p-3 rounded">
		<i class="fa fa-file-pdf-o"></i> Document
	</div>
	<p>The smart always work on their mistakes. Take a step to get your response evaluated by our team.</p>
	@if($attempt->answer)
	<a href="{{ route('test.review',$test->slug)}}">
	<button class="btn btn-sm btn-success">Expert Review</button>
	</a>
	@else
	<a href="{{ route('pricing')}}">
	<button class="btn btn-sm btn-outline-primary">Choose a Plan</button>
	</a>
	@endif
</div>
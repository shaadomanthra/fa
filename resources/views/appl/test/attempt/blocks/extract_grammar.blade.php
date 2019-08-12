<div class="mb-3">
	<div class="bg-white border-top p-4">
	<h4><i class="fa fa-check-square-o"></i> {{ $extract->name }} </h4>
	@if(strip_tags($extract->text))
	<div class="instructions">{!!$extract->text!!}</div>
	@endif
	<hr>
	@if(count($extract->mcq)!=0)
		@include('appl.test.attempt.blocks.mcq')
	@endif
	
	@if(count($extract->fillup)!=0)
		@include('appl.test.attempt.blocks.fillup')
	@endif
	</div>
</div>
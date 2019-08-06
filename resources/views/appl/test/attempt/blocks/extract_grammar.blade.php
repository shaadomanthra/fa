<div class="mb-3">
	<div class="bg-white border-top p-4">
	<h4><i class="fa fa-check-square-o"></i> {{ $extract->name }} </h4>
	@if(strip_tags($extract->text))
	<div class="instructions">{!!$extract->text!!}</div>
	@endif
	<hr>
	@if($extract->mcq()->first())
		@include('appl.test.attempt.blocks.mcq')
	@endif
	@if($extract->fillup()->first())
		@include('appl.test.attempt.blocks.fillup')
	@endif
	</div>
</div>
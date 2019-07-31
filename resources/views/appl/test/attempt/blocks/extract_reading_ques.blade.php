<div class="mb-3">
	
	
	@if($extract->mcq()->first())
	<div class="border-top pt-3 pb-3">
		@include('appl.test.attempt.blocks.mcq')
	</div>
	@endif
	
	@if($extract->fillup()->first())
	<div class="border-top pt-3 pb-3">
		@include('appl.test.attempt.blocks.fillup')
	</div>
	@endif
</div>
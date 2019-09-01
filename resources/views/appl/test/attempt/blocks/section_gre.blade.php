
<div class="mb-3">
	<div class="part">
	<h3><i class="fa fa-clone"></i> {{ $section->name}}</h3>
	@if(strip_tags($section->instructions))
	<p>{!! $section->instructions !!}</p>
	@endif
	</div>
	
	<div class="mb-3">
	<div class="bg-white border-top p-4">
	@if(count($section->mcq_order)!=0)
		@include('appl.test.attempt.blocks.mcq_gre')
	@endif

	@if(count($section->fillup_order)!=0)
		@include('appl.test.attempt.blocks.fillup_gre')
	@endif
	</div>
</div>
</div>
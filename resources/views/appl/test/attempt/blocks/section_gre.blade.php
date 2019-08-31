
<div class="mb-3">
	<div class="part">
	<h3><i class="fa fa-clone"></i> {{ $section->name}}</h3>
	@if(strip_tags($section->instructions))
	<p>{!! $section->instructions !!}</p>
	@endif
	</div>
	
	@foreach($section->extracts as $k=>$extract )
		@include('appl.test.attempt.blocks.extract_gre')
	@endforeach
</div>
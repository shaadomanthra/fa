<div class="mb-3">
	<div class="part">
	<h3><i class="fa fa-clone"></i> {{ $section->name}}
	</h3>
	<p>{!! $section->instructions !!}</p>
	</div>
	
	@foreach($section->extracts as $k=>$extract )
		@include('appl.test.attempt.blocks.extract_reading_text')
	@endforeach
</div>
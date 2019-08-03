<div class="mb-3">
	
	@foreach($section->extracts as $k=>$extract )
		@include('appl.test.attempt.blocks.extract_reading_text')
		@include('appl.test.attempt.blocks.extract_reading_ques')
	@endforeach
</div>
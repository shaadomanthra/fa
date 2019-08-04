<div class="mb-3 r r{{$section->id}} r{{$s+1}}" @if($s!=0)style="display:none" @endif>
	
	@foreach($section->extracts as $k=>$extract )
		@include('appl.test.attempt.blocks.extract_reading_text')
		@include('appl.test.attempt.blocks.extract_reading_ques')
	@endforeach
</div>
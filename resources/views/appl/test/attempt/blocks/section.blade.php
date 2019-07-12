<div class="mb-3">
	<div class="part">
	<h3><i class="fa fa-clone"></i> {{ $section->name}}
		<button class="btn load_s{{$s}} btn-outline-primary btn-sm mt-2 mt-sm-0" data-file="{{ asset('storage/'.$section->file) }}" onclick="this.blur();" type="button">Play Instructions</button>
	</h3>
	<p>{!! $section->instructions !!}</p>
	</div>
	
	@foreach($section->extracts as $k=>$extract )
		@include('appl.test.attempt.blocks.extract')
	@endforeach
</div>
<div class="mb-3">
	<div class="bg-white border-top p-4">
	<h4><i class="fa fa-check-square-o"></i> {{ $extract->name }} <button class="btn load_{{$s.$k}} btn-outline-primary btn-sm mt-2 mt-sm-0" data-file="{{ asset('storage/'.$extract->file) }}" onclick="this.blur();" type="button">Play Track</button></h4>
	<div class="instructions">{!!$extract->text!!}</div>
	<hr>

	@if($extract->mcq()->first())
		@include('appl.test.attempt.blocks.mcq')
	@endif
	
	@if($extract->fillup()->first())
		@include('appl.test.attempt.blocks.fillup')
	@endif
	</div>
</div>
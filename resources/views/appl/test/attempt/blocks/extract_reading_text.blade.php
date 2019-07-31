<div class="mb-3">
	<div class=" border-top pt-4 pb-4 pr-2 pl-2
	@foreach($extract->mcq as $m)
		{{$m->qno}}
	@endforeach
	@foreach($extract->fillup as $m)
		{{$m->qno}}
	@endforeach
	">
	<h4><i class="fa fa-check-square-o"></i> {{ $extract->name }} </h4>
	<div class="instructions">{!!$extract->text!!}</div>
	<hr>
	</div>
</div>
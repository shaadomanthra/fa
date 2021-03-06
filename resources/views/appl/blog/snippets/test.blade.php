<div class="test_container">

<form id="ajaxtest" class="test" action="{{route('attempt.store',$app->test->slug)}}" method="post"> 
@if($testtype->name=='GRAMMAR')
<div class="border">
 <div class="mb-3">
	<div class="part">
		<h3><i class="fa fa-clone"></i> {{ $app->test->name}}</h3>
		@if(strip_tags($app->test->description))
		<p>{!! $app->test->description !!}</p>
		@endif
	</div>
	<div class="bg-white border-top p-4">
		@if(count($app->test->mcq_order)!=0)
		@include('appl.test.attempt.blocks.mcq_grammar')
		@endif

		@if(count($app->test->fillup_order)!=0)
		@include('appl.test.attempt.blocks.fillup_grammar')
		@endif

		<input type="hidden" name="test_id" value="{{ $app->test->id }}">
		<input type="hidden" name="user_id" value="@if(\auth::user()) {{ \auth::user()->id }}@endif ">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="ajax" value="1">

		<button class="btn btn-success btn-lg ajaxtestsubmit" type="submit" >Submit</button>
	</div>
 </div>
</div>
@elseif($testtype->name=='LISTENING')

	@if(file_exists(public_path().'/storage/'.$test->file) && $test->file)

		@include('appl.test.attempt.blocks.audio')

	@endif

	<div class="border">
	@foreach($test->sections as $s=>$section)
		@include('appl.test.attempt.blocks.section')
	@endforeach


	<input type="hidden" name="test_id" value="{{ $app->test->id }}">
	<input type="hidden" name="user_id" value="@if(\auth::user()) {{ \auth::user()->id }}@endif ">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="ajax" value="1">

	<div class="pr-4 pl-4 pb-4 pt-0">
	<button class="btn btn-success btn-lg ajaxtestsubmit " type="submit" >Submit</button>
	</div>
	</div>

@elseif($testtype->name=='ENGLISH')
<div class="border ">
	@foreach($app->test->sections as $s=>$section)
	    @include('appl.test.attempt.blocks.section_english')
	@endforeach

	<input type="hidden" name="test_id" value="{{ $app->test->id }}">
	<input type="hidden" name="user_id" value="@if(\auth::user()) {{ \auth::user()->id }}@endif ">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="ajax" value="1">

	<div class="pr-4 pl-4 pb-4 pt-0">
	<button class="btn btn-success btn-lg ajaxtestsubmit " type="submit" >Submit</button>
	</div>
</div>

@endif
</form>
</div>

<div class="result_container" style="display: none">
<div class="border">
	<div class="result">

	</div>
</div>
</div>

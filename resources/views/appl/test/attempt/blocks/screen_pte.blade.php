
<div class="">
	<div class="part p-3 text-white" style="background:#5ea0c1;">
	<div class="row">
		<div class="col-12  col-lg-6">
			<h3 class="mb-3 mt-3"><i class="fa fa-clone"></i> {{ $test->name}} </h3>
		</div>
		<div class="col-12 col-lg">
			<div class="row no-gutters">
			
				
				<div class="col-4 ">
				<a href="#" class="white gre_prev disabled" data-qno="0">
					<div class="border rounded  p-1 ml-1 mr-1 mb-0 mb-md-0">
						<div class="text-center">Prev <br class="d-none d-md-block">
						<i class="fa fa-arrow-left "></i></div>
					</div>
				</a>
				</div>
				<div class="col-4 ">
				<a href="#" class="white gre_next" data-qno="2" >
					<div class="border rounded  p-1 ml-1 mb-0 mb-md-0">
						<div class="text-center">Next <br class="d-none d-md-block">
						<i class="fa fa-arrow-right "></i></div>
					</div>
				</a>
				</div>
				
				<div class="col-4 col-md-4">
				<a href="#" class="dark gre_submit" data-qno="2" data-toggle="modal" data-target="#test_submit">
					<div class="border border-warning rounded bg-warning  p-1 ml-1 mb-0 mb-md-0">
						<div class="text-center">Submit <br class="d-none d-md-block">
						<i class="fa fa-paper-plane "></i></div>
					</div>
				</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="p-2 pl-3 pr-3" style="background:#d4f1ff;"> <b>Section <span class="gre_section">1</span> of {{count($test->sections)}}</b> &nbsp;|&nbsp; Question <span class="gre_qno">1</span> of 
	@foreach($test->sections as $se=>$sec)
		<span class="gre_sec sec_{{($se+1)}}" @if($se!=0)style="display:none" @endif>{{count($sec->mcq_order)}}</span>
	@endforeach
	<span class="d-block d-md-inline float-md-right"><span class="time_count" id="timer">0:27:39</span> <span class="time_count d-none" id="timer2"></span>&nbsp;<span class="hide_time" style="cursor: pointer;"><i class="fa fa-minus-circle"></i> Hide Time</span></span>
	</div>
	

	<div class="">
	<div class="bg-white border-top p-4">
	@foreach($test->sections as $s=>$section)
	<div class="section_data_{{$s+1}}" data-qno="{{$section->mcq_order[0]->qno}}" data-section="{{$s+1}}"></div>
	@if(count($section->mcq_order)!=0)
		@include('appl.test.attempt.blocks.mcq_gre')
	@endif
	@if(count($section->fillup_order)!=0)
		@include('appl.test.attempt.blocks.fillup_gre')
	@endif
	@endforeach
	</div>
	</div>
</div>

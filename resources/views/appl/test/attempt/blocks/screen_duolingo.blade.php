<div class="my-3 mt-md-5" style="box-shadow: 1px 1px 2px 2px #e1e1e1;">
	<div class="bg-white  p-3 py-5 p-md-5">

		@if($test->test_time)
		<div class="mb-3 text-secondary" style="font-size: 18px;"><span class="d-block  "><span class="time_count" id="timer">0:00:00</span> <span class="time_count d-none" id="timer2"></span>&nbsp;</span></div>
		@endif
		<div class="progress mb-4" style="height:5px;@if(count($test->sections)<2)display:none;@endif">
  <div class="progress-bar" role="progressbar" style="width: 0%;background: #ff8159" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
	@foreach($test->sections as $s=>$section)
	
	@if(isset($section->mcq_order[0]->qno))
	<div class="section_data_{{$s+1}}" data-qno="{{$section->mcq_order[0]->qno}}" data-section="{{$s+1}}"></div>
	@endif

	@if(isset($section->fillup_order[0]->qno))
	<div class="section_data_{{$s+1}}" data-qno="{{$section->fillup_order[0]->qno}}" data-section="{{$s+1}}"></div>
	@endif
	
	<div class="qblock greblock_{{($s+1)}} p-3" data-qno="{{$s}}"  data-section="{{$s+1}}" data-sno="{{$s+1}}" data-qcount="{{(count($section->mcq_order)+count($section->fillup_order))}}" data-scount="{{count($test->sections)}}" @if($s!=0)style="display:none"@endif>

		@if(count($section->mcq_order)!=0)
			@include('appl.test.attempt.blocks.mcq_english')
		@endif
		@if(count($section->fillup_order)!=0)
			@include('appl.test.attempt.blocks.fillup_english')
		@endif
	</div>
	@endforeach

	<hr class="hr">
<div class="" style="">
	<div class=" p-0 " style="">
	<div class="row">
		
		<div class="col-12 col-md-10">
			&nbsp;
		</div>
		<div class="col-12 col-md-2">
			<div class="row no-gutters">
				
				<div class="col-12 ">
				<a href="#" class="white gre_next disabled" data-qno="2" data-duo="1">
					<div class=" rounded  p-1 ml-1 mb-0 mb-md-0 next-btn bg-silver @if(count($test->sections)<2) btn-submit-duo @endif" >
						<div class="text-center p-2"><i class="fa fa-arrow-right "></i> <span class="next_text">@if(count($test->sections)<2) Submit @else Next @endif</span>
						</div>
					</div>
				</a>
				</div>
				
				
			</div>
		</div>
	</div>
</div>

	</div>
	</div>
</div>

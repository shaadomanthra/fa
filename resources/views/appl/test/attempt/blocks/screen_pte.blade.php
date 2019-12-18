<div class="">
	<div class="part p-3 text-white" style="background:#5ea0c1;">
	<div class="row">
		<div class="col-12  col-lg-6">
			<h3 class="mb-3 mt-3"><i class="fa fa-clone"></i> {{ $test->name}} </h3>
		</div>
		<div class="col-12 col-lg">
			<div class="row no-gutters">
				<div class="col-4 ">
				<a href="#" class="white gre_prev disabled" data-qno="0" data-qqno="0">
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
	<div class="p-2 pl-3 pr-3" style="background:#d4f1ff;"> <b>Item <span class="gre_section">1</span> of {{count($test->sections)}}</b> &nbsp;
	<span class="d-block d-md-inline float-md-right"><span class="time_count" id="timer">0:00:00</span> <span class="time_count d-none" id="timer2"></span>&nbsp;<span class="hide_time" style="cursor: pointer;"><i class="fa fa-minus-circle"></i> Hide Time</span></span>
	</div>
	

	<div class="">
	<div class="bg-white border-top p-4">
	@foreach($test->sections as $s=>$section)
	
	@if(isset($section->mcq_order[0]->qno))
	<div class="section_data_{{$s+1}}" data-qno="{{$section->mcq_order[0]->qno}}" data-section="{{$s+1}}"></div>
	@endif

	@if(isset($section->fillup_order[0]->qno))
	<div class="section_data_{{$s+1}}" data-qno="{{$section->fillup_order[0]->qno}}" data-section="{{$s+1}}"></div>
	@endif
	
	<div class="qblock greblock_{{($s+1)}}" data-qno="{{$s}}"  data-section="{{$s+1}}" data-sno="{{$s+1}}" data-qcount="{{(count($section->mcq_order)+count($section->fillup_order))}}" @if($s!=0)style="display:none"@endif>

	<style>
		ul.sortlist{ list-style: none; margin:0px;padding:0px; }
		li.sortitem{ list-style: none; border:1px solid #888; padding:10px; margin:5px; }
	</style>
	<ul id = "sortable-1" class="sortlist"><h3>List 1</h3>
         <li class = "default sortitem">A</li>
         <li class = "default sortitem">B</li>
         <li class = "default sortitem">C</li>
         <li class = "default sortitem">D</li>
      </ul>
      <ul id = "sortable-2"><h3>List 2</h3>
         <li class = "default">a</li>
         <li class = "default">b</li>
         <li class = "default">c</li>
         <li class = "default">d</li>
      </ul>

	@if(count($section->mcq_order)!=0)
		@include('appl.test.attempt.blocks.mcq_pte')
	@endif
	@if(count($section->fillup_order)!=0)
		@include('appl.test.attempt.blocks.fillup_pte')
	@endif
	</div>
	@endforeach
	</div>
	</div>
</div>

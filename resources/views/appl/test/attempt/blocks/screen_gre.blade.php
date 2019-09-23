<div class="mb-3">
	<div class="part p-3 text-white" style="background:#0fa0ad;">
	<div class="row">
		<div class="col-12  col-lg-5">
			<h3 class="mb-3 mt-3"><i class="fa fa-clone"></i> {{ $test->name}}</h3>
		</div>
		<div class="col-12 col-lg">
			<div class="row no-gutters">
				<div class="col-6 col-md-3 col-lg-3">
					<a href="" class="text-light">
					<div class="border rounded  text-white p-2 mr-1 mb-3 mb-md-0">
						<div class="text-center">Exit Section<br>
						<i class="fa fa-toggle-right d-none d-md-block"></i></div>
					</div>
					</a>
				</div>
				<div class="col-6 col-md-3 col-lg-3">
				<a href="" class="text-light" data-toggle="modal" data-target="#review">
					<div class="border rounded  p-2 ml-1 mr-1 mb-3 mb-md-0">
						<div class="text-center">Review<br>
						<i class="fa fa-bookmark-o d-none d-md-block"></i></div>
					</div>
				</a>
				</div>
				<div class="col-4 col-md-2 col-lg-2">
					<div class="border rounded  p-2 ml-1 mr-1 mb-0 mb-md-0">
						<div class="text-center">Mark<br>
						<i class="fa fa-square-o d-none d-md-block"></i></div>
					</div>
				</div>
				
				<div class="col-4 col-md-2">
				<a href="" class="text-light">
					<div class="border rounded  p-2 ml-1 mr-1 mb-0 mb-md-0">
						<div class="text-center">Prev<br>
						<i class="fa fa-arrow-left d-none d-md-block"></i></div>
					</div>
				</a>
				</div>
				<div class="col-4 col-md-2">
				<a href="" class="text-light">
					<div class="border rounded  p-2 ml-1 mb-0 mb-md-0">
						<div class="text-center">Next<br>
						<i class="fa fa-arrow-right d-none d-md-block"></i></div>
					</div>
				</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="p-2 pl-3 pr-3" style="background:#d5f9f9;"> <b>Section 1 of 3</b> &nbsp;|&nbsp; Question 3 of 7
	<span class="float-center float-md-right"><span class="time_count" id="timer">0:27:39</span> &nbsp;<span class="hide_time" style="cursor: pointer;"><i class="fa fa-minus-circle"></i> Hide Time</span></span>
	</div>
	
	<div class="mb-3">
	<div class="bg-white border-top p-4">
	@if(count($section->mcq_order)!=0)
		@include('appl.test.attempt.blocks.mcq_gre')
	@endif

	@if(count($section->fillup_order)!=0)
		@include('appl.test.attempt.blocks.fillup_gre')
	@endif
	</div>
</div>
</div>
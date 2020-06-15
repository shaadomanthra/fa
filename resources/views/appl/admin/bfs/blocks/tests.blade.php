

<div class="bg-white p-4">
	<div>
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="mytest-tab" data-toggle="tab" href="#mytest" role="tab" aria-controls="mytest" aria-selected="false"><h4 class="mt-2"> <i class="fa fa-tasks"></i> Tests</h4></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="myassignment-tab" data-toggle="tab" href="#myassignment" role="tab" aria-controls="myassignment" aria-selected="false"><h4 class="mt-2"> <i class="fa fa-download"></i> Resources</h4></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="myproduct-tab" data-toggle="tab" href="#myproduct" role="tab" aria-controls="myproduct" aria-selected="false"><h4 class="mt-2"> <i class="fa fa-check-square-o"></i> Survey</h4></a>
			</li>
			
			
		</ul>
	</div>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="mytest" role="tabpanel" aria-labelledby="mytest-tab">
  	<div class="mt-4">
  	<form class=" mb-4" method="GET" action="{{ route('home') }}">
			<div class="input-group input-group-lg">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-search"></i></div>
				</div>
				<input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
				value="{{Request::get('item')?Request::get('item'):'' }}">
			</div>
		</form>
    <div id="search-items" class="">
		@include('appl.admin.bfs.blocks.testlist')
	</div>
	</div>
  </div>
  <div class="tab-pane fade" id="myproduct" role="tabpanel" aria-labelledby="myproduct-tab">
  	<div class="mt-4">
  		
    <div id="search-items2" class="">
		@include('appl.admin.bfs.blocks.productlist')
	</div>
	</div>
  </div>

   <div class="tab-pane fade" id="myassignment" role="tabpanel" aria-labelledby="myassignments-tab">
  	<div class="mt-4">
  		
    <div id="search-items2" class="">
		@include('appl.admin.bfs.blocks.assignments')
	</div>
	</div>
  </div>
 
</div>

</div>
@if(isset($secs))
	<div class="row">
	@foreach($secs as $sec =>$section)
	
		<div class="col-12 col-md-6">
		<div class="card mb-3 bg-light mb-4"  style="background: #FFF;border: 2px solid #EEE;">
			<div class="card-header h3">
				<i class="fa fa-gg"></i> {{ $sec }}
			</div>
			<div class="card-body">
			

						<div class="p-2 " height="200px">
						<canvas id="{{$section->section_id}}Container" width="600" height="200px"></canvas>
						<div class="text-center mt-4">
							<span style="color:rgba(60, 120, 40, 0.8)"><i class="fa fa-square"></i> Excellent </span>

							&nbsp;<span style="color:rgba(60, 108, 208, 0.8)"><i class="fa fa-square"></i> Good </span>&nbsp;
							<span style="color:rgba(255, 206, 86, 0.9)"><i class="fa fa-square"></i> Average</span>
						&nbsp;<span style="color:rgba(219, 55, 50, 0.9)"><i class="fa fa-square"></i> Poor</span></div>
						<h3 class="text-center mt-3">Average Score - {{$section->average}}</h3>
					</div>
					@if($section->suggestion)
					<div class=" border p-3 rounded" style="background:#eee">
							<h3>Remarks</h3>
							<div>{!! $section->suggestion !!}</div>
					</div>
					@endif
				</div>
				
			</div>
		</div>
		
	@endforeach
	</div>
@endif
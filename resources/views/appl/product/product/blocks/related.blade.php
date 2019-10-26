<div class="mt-4">
	<h4 class="mb-3">Related Tests</h4>
	<div class="row">
		@if($obj->related_tests)
		@foreach($obj->related_tests as $k=>$t)
		@if($k<4)
		<div class="col-12 col-md-6 mb-3">
			<div class="card"  style="box-shadow: 2px 3px #f1f7fb;background-image: linear-gradient(#ffeef7 5%, white 80%,white 15%);">
				<div class="card-body">
					<h5>{{$t->name}}
						@if($t->price==0)<span class="badge badge-warning">FREE</span>@endif
					</h5>
					<p>
						@if($t->marks){{$t->marks}} Questions @endif
						@if($t->marks && $t->test_time) | @endif
						@if($t->test_time) {{$t->test_time}} min @endif
						<br>
						@if($t->level)
						<div class="">
							<B>Level : </B>
							<span class="text-success">
								@for($i=$t->level;$i>0;$i--)
								<i class="fa fa-star "></i>
								@endfor
							</span>
							<span class="text-secondary">
								@for($i=(5-$t->level);$i>0;$i--)
								<i class="fa fa-star-o "></i>
								@endfor
							</span>
						</div>
						@endif
					</p>

					<a href="{{ route('test',$t->slug)}}">
						<button class="btn btn-sm btn-success">view</button>
					</a>
				</div>

			</div>
		</div> 
		@endif
		@endforeach
		@endif
	</div>  
</div>
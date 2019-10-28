<div class="container ">
 <h3 class="mb-4">Free Listening Mini Tests 
 	<a href="{{ route('product.view','listening-mini-test-pack') }}">
 		<button class="btn btn-sm btn-primary">view all</button>
 	</a>
 </h3>

<div  class="row ">
	@for($i=1;$i<7;$i++)
  <div class="col-12 col-md-6 col-lg-4">
  		<div class="card mb-4">
  			<div class="card-body">
  				<h5>
  					<a href="{{ route('test','listening-mini-test-'.$i) }}">
  					<i class="fa fa-clone"></i> Listening Mini Test #{{$i}} 
  					</a>	
        </h5>
  				@if(in_array($i,[3,5]))
  				<div class="text-secondary">6 Questions | 6 min</div>
  				@else
  				<div class="text-secondary">5 Questions | 5 min</div>
  				@endif
  				<B>Level : </B>
          <span class="text-success"><i class="fa fa-circle "></i> <i class="fa fa-circle "></i> <i class="fa fa-circle "></i></span><span class="text-secondary"> <i class="fa fa-circle-o "></i> <i class="fa fa-circle-o "></i></span>

  					
  			</div>
  		</div>
  </div>
  @endfor

</div>
</div>
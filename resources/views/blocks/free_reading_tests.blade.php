<div class="container ">
 <h3 class="mb-4">Free Reading Mini Tests 
  <a href="{{ route('product.view','reading-mini-test-pack') }}">
  <button class="btn btn-sm btn-primary">view all</button>
</a>
</h3>
<div  class="row ">
	@for($i=1;$i<7;$i++)
  <div class="col-md-6 col-lg-4">
  		<div class="card mb-4">
  			<div class="card-body">
  				<h5><a href="{{ route('test','reading-mini-test-'.$i) }}"><i class="fa fa-clone"></i> Reading Mini Test #{{$i}} </a>
            <a href="{{ route('test','reading-mini-test-'.$i) }}">
              <button class="btn btn-sm btn-outline-primary float-right">view</button>
            </a>
          </h5>
  				<div class="text-secondary">5 Questions | 10 min</div>
  				<B>Level : </B>
  					<span class="text-success"><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i></span><span class="text-secondary"><i class="fa fa-star-o "></i><i class="fa fa-star-o "></i></span>
  			</div>
  		</div>
  </div>
  @endfor

</div>
</div>
<div class="container ">
 <h3 class="mb-4 pl-2 pl-md-0">Free Reading Mini Tests 
  <a href="{{ route('product.view','reading-mini-test-pack') }}">
  <button class="btn btn-sm btn-primary">view all</button>
</a>
</h3>
<div  class="row ">
	@for($i=1;$i<7;$i++)
  <div class="col-md-6 col-lg-4">
  		<div class=" mb-4">
        <a href="{{ route('test','reading-mini-test-'.$i) }}" class="text-secondary nostyle">
  			<div class="card-body hover-bg p-2 p-md-3">
  				<h5><i class="fa fa-clone"></i> Reading Mini Test #{{$i}}</h5>
  				<div class="text-secondary">5 Questions | 10 min</div>
  				<B>Level : </B>
  					<span class="text-success"><i class="fa fa-circle "></i> <i class="fa fa-circle "></i> <i class="fa fa-circle "></i></span><span class="text-secondary"> <i class="fa fa-circle-o "></i> <i class="fa fa-circle-o "></i></span>
  			</div>
         </a>
  		</div>
  </div>
  @endfor

</div>
</div>
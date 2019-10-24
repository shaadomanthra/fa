<div class="container ">
 <h3 class="mb-4">Free Reading Mini Tests <button class="btn btn-sm btn-primary">view all</button></h3>
<div  class="row ">
	@for($i=1;$i<7;$i++)
  <div class="col-md-6 col-lg-4">
  		<div class="card mb-4">
  			<div class="card-body">
  				<h5><i class="fa fa-clone"></i> Reading Mini Test #{{$i}} <button class="btn btn-sm btn-outline-primary float-right">Try Now</button></h5>
  				<div class="text-secondary">5 Questions | 5 min</div>
  				<B>Level : </B>
  					<span class="text-success"><i class="fa fa-star "></i><i class="fa fa-star "></i><i class="fa fa-star "></i></span><span class="text-secondary"><i class="fa fa-star-o "></i><i class="fa fa-star-o "></i></span>
  			</div>
  		</div>
  </div>
  @endfor

</div>
</div>
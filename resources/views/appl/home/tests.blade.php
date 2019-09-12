<div class="bg-light">
	<div class="p-2 p-md-3"></div>
<div class="container">
  <div class="row">
  
  	<div class="col-12">
  		<div class="">
  		<div class="row">
  		@foreach($tests as $test)
  			<div class="col-12 col-md-6 col-lg-4">
  			<div class="card mb-4" >
  				@if(\Storage::disk('public')->exists($test->image) && $test->image )
			  <img src="{{ asset('storage/'.$test->image)}}" class="card-img-top" alt="...">
			  @endif
			  <div class="card-body">
			    <h5 class="card-title">{{ $test->name }}</h5>
          @if($test->price)
          <span class="badge badge-primary">PREMIUM</span>
          @else
          <span class="badge badge-warning">FREE</span>
          @endif
			    <p class="card-text">{!! substr(strip_tags($test->details),0,200) !!}</p>
			    <a href="{{ route('test',$test->slug)}}" class="btn btn-success">view</a>
			  </div>
			</div>
			</div>
  		@endforeach
  		</div>
  		</div>
  	</div>

  </div>
</div>
</div>
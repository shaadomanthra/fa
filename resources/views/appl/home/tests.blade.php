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
			  
        <div class="card-img-top bg-image" style="background-image: url({{ asset(url('/').'/storage/'.$test->image)}})" alt="{{$test->name}}"> 
        </div>
			  @endif
			  <div class="card-body">
			    <h5 class="card-title">{{ $test->name }}</h5>
          @if($test->price)
          <span class="badge badge-primary">PREMIUM</span>
          @else
          <span class="badge badge-warning">FREE</span>
          @endif
			    <div class="mt-2">
			    <a href="{{ route('test',$test->slug)}}" class="btn btn-success">view</a>
        </div>
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
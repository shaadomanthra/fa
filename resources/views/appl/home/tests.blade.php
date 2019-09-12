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
			  
              <picture>
  <source srcset="{{ asset('/storage/test/'.$test->slug.'_300.webp') }} 320w,
             {{ asset('/storage/test/'.$test->slug.'_600.webp') }}  480w,
             {{ asset('/storage/test/'.$test->slug.'_900.webp') }}  800w,
             {{ asset('/storage/test/'.$test->slug.'_1200.webp') }}  1100w" type="image/webp" sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px" alt="{{  $test->name }}">
  <source srcset="{{ asset('/storage/test/'.$test->slug.'_300.jpg') }} 320w,
             {{ asset('/storage/test/'.$test->slug.'_600.jpg') }}  480w,
             {{ asset('/storage/test/'.$test->slug.'_900.jpg') }}  800w,
             {{ asset('/storage/test/'.$test->slug.'_1200.jpg') }}  1100w," type="image/jpeg" sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px" alt="{{  $test->name }}"> 
  <img srcset="{{ asset('/storage/test/'.$test->slug.'_300.jpg') }} 320w,
             {{ asset('/storage/test/'.$test->slug.'_600.jpg') }}  480w,
             {{ asset('/storage/test/'.$test->slug.'_900.jpg') }}  800w,
             {{ asset('/storage/test/'.$test->slug.'_1200.jpg') }}  1100w,"
      sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px"
      src="{{ asset('/storage/test/'.$test->slug.'_600.jpg') }} " class="w-100 d-print-none" alt="{{  $test->name }}">
</picture>

			  @endif
			  <div class="card-body">
			    <h5 class="card-title">{{ $test->name }} @if($test->price)
          <span class="badge badge-primary">PREMIUM</span>
          @else
          <span class="badge badge-warning">FREE</span>
          @endif</h5>
          
			    <div class="mt-2">
			    <a href="{{ route('test',$test->slug)}}" class="btn btn-outline-secondary">view</a>
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
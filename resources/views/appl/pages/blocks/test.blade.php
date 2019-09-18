<div class="col-12 col-md-6 col-lg-4"> 
			<div class="card mb-4 ">
				@if(\Storage::disk('public')->exists($test->image)  && $test->image)
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
                     src="{{ asset('/storage/test/'.$test->slug.'_300.jpg') }} " class="w-100 d-print-none" alt="{{  $test->name }}">
                   </picture>

                   @endif
				<div class="card-body">
					
					<h5 class="card-title">
						<a href="{{ route('test',$test->slug) }}">{{$test->name}}</a>
						
					</h5>
					<h6 class="card-subtitle mb-2 text-muted">
						<span class="">Valid Till - {{date('d M Y', strtotime($order->expiry))}}</span>
					</h6>
					

					<div class="mt-3">
					@if(!\auth::user()->attempt($test->id))
					<a href="{{ route('test.try',$test->slug) }}">
						<button class="btn btn-lg btn-success">Try Now</button>
					</a>
					@else
					@if($test->testtype->name == 'SPEAKING' || $test->testtype->name == 'WRITING')
					<a href="{{ route('test.try',$test->slug)}}" class="btn btn-secondary mb-1"><i class="fa fa-eye"></i> View Response</a>
					@else
					<a href="{{ route('test.analysis',$test->slug)}}" class="btn btn-secondary mb-1"><i class="fa fa-bar-chart"></i> Test Report</a>
					@endif
					@endif
					</div>

				</div>
			</div>
		</div>
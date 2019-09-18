<div>
  <h3 class="border border-secondary text-secondary p-3 mt-4 mb-4">My Products</h3>
  <div class="row mb-4">
    @foreach(auth::user()->orders()->where('status',1)->get() as $k=>$order)
    @if($order->product)
    <div class="col-12"> 
      <div class="card mb-4 ">
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-4 col-md-3">
              @if(\Storage::disk('public')->exists($order->product->image)  && $order->product->image)

              <img 
              src="{{ asset('storage/'.$order->product->image) }} " class="w-100 d-print-none mb-3" alt="{{  $order->product->name }}">


              @endif
            </div>
            <div class="col-12 col-md-9">

              <h4 class="card-title">
                <a href="{{ route('product.view',$order->product->slug) }}">{{$order->product->name}}</a>
              </h4>
              <h6 class="card-subtitle mb-2 text-muted">
                @if(strtotime($order->expiry) > strtotime(date('Y-m-d')))
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-danger">Expired</span>
                @endif
              </h6>
              <p> 
                {!! $order->product->details !!}
              </p>
              <p class="card-text mb-4">Valid Till: {{date('d M Y', strtotime($order->expiry))}}</p>

            </div>
          </div>


          <div class="row">
            @foreach($order->product->tests as $test)
            <div class="col-12 col-md-6">

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

                    <p>
                      {!! $test->details !!}
                    </p>


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
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
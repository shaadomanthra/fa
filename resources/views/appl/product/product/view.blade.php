@extends('layouts.app')

@section('title',$obj->name.' - First Academy' )
@section('description', strip_tags($obj->description))
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET, '.$obj->name)

@section('content')
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card  mb-4" >
        <div class="card-body p-5">
          <div class="row">
            <div class="col @if($obj->image) col-md-9 @endif">
               <h1 class="h1 mb-0"> {{ $obj->name }} 
                @can('update',$obj)
                <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan
          </h1>
          <p>
             {!! $obj->description !!} 
          </p>
          <p>
             {!! $obj->details !!} 
          </p>
          @if(\auth::user())
            @if($obj->order)
              @if(strtotime($obj->order->expiry) > strtotime(date('Y-m-d')))
              <div class="border p-3 rounded ">
                <i class="fa fa-check-circle text-success"></i> Your service is activated <span class="text-secondary">{{ $obj->order->created_at->diffForHumans()}}</span>
              </div>
              @else
              <div class="border p-3 rounded mb-3">
                <i class="fa fa-times-circle text-danger"></i> Your service is Expired
              </div>

              @if($obj->price !=0)
              <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
              <a href="{{ route('product.checkout',$obj->slug) }}">
              <button class="btn btn-lg btn-success">Buy Now</button>
              </a>
              @else
                <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
              <form method="post" action="{{ route('product.order')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="txn_amount" value="0">
              <input  type="hidden" name="product_id"  value="{{ $obj->id }}">
              <input  type="hidden" name="coupon"  value="FREE">
              <button class="btn btn-lg btn-success" type="submit">Access Now</button>
              </form>
              @endif

              @endif
            @else
              @if($obj->price !=0)
              <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
              <a href="{{ route('product.checkout',$obj->slug) }}">
              <button class="btn btn-lg btn-success">Buy Now</button>
              </a>
              @else
                <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
              <form method="post" action="{{ route('product.order')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="txn_amount" value="0">
              <input  type="hidden" name="product_id"  value="{{ $obj->id }}">
              <input  type="hidden" name="coupon"  value="FREE">
              <button class="btn btn-lg btn-success" type="submit">Access Now</button>
              </form>
              @endif
            @endif
          @else
            @if($obj->price !=0)
            <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
            <a href="{{ route('product.checkout',$obj->slug) }}">
            <button class="btn btn-lg btn-success">Buy Now</button>
            </a>
            @else
              <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
            @endif

          @endif
            </div>
            @if($obj->image)
            <div class="col-12  col-md-3">
                <img src="{{ asset('storage/'.$obj->image) }}" class="w-100 d-none d-md-block">
            </div>
            @endif

          </div>
         

          
        </div>
      </div>

      <div class="row">
        @foreach($obj->groups as $group)

        @if($group->status)
          <div class="col-12 @if(count($obj->groups)==1) col-md-6 @endif
            @if(count($obj->groups)==2) col-md-6 col-lg-6 @endif
            @if(count($obj->groups)==3) col-md-6 col-lg-4 @endif
            @if(count($obj->groups)>3) col-md-6 col-lg-3 @endif
             mb-3">
              <div class="card" >
                @if(\Storage::disk('public')->exists($group->image)  && $group->image)
                   <div class="card-img-top bg-image" style="background-image: url({{ asset(url('/').'/storage/'.$group->image)}})"> 
</div>
  @endif
  <div class="card-body">
    <h5 class="card-title">{{ $group->name}}  @can('update',$obj)
                <a href="{{ route('group.edit',$group->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan</h5>
    <p class="card-text">{!! $group->description !!}</p>
    @foreach($group->tests as $test)
    @if($test->testtype)
    @if($test->status)
    <a href="{{ route('test.instructions',$test->slug)}}?product={{$obj->slug}}" class="btn btn-outline-secondary mb-1">{{$test->name}}</a>
    @endif
    @endif
    @endforeach
  </div>
</div>
          </div>
          @endif
          @endforeach

      </div>

            <div class="row">
        @foreach($obj->tests()->orderBy('name','asc')->get() as $test)

        @if($test->status)
          <div class="col-12 @if(count($obj->tests)==1) col-md-6 @endif
            @if(count($obj->tests)==2) col-md-6 col-lg-6 @endif
            @if(count($obj->tests)==3) col-md-6 col-lg-4 @endif
            @if(count($obj->tests)>3) col-md-6 col-lg-3 @endif
             mb-3">
              <div class="card" >
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
    <h5 class="card-title">{{ $test->name}}  @can('update',$obj)
                <a href="{{ route('test.edit',$test->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan</h5>
    <p class="card-text">
      {{ substr(strip_tags($test->details),0,200) }}
      @if(strlen(strip_tags($test->details))>200)
      ...
      @endif
    </p>

    @if($test->status)
    @if(\auth::user())
      @if(!\auth::user()->attempt($test->id))
      <a href="{{ route('test.instructions',$test->slug)}}?product={{$obj->slug}}" class="btn btn-primary mb-1"><i class="fa fa-paper-plane"></i> Take Test</a>
      @else
        @if($test->testtype->name == 'SPEAKING' || $test->testtype->name == 'WRITING')
        <a href="{{ route('test.try',$test->slug)}}?product={{$obj->slug}}" class="btn btn-secondary mb-1"><i class="fa fa-eye"></i> View Response</a>
        @else
        <a href="{{ route('test.analysis',$test->slug)}}?product={{$obj->slug}}" class="btn btn-secondary mb-1"><i class="fa fa-bar-chart"></i> Test Report</a>
        @endif
      @endif
    @else
      <a href="{{ route('test.instructions',$test->slug)}}?product={{$obj->slug}}" class="btn btn-primary mb-1"><i class="fa fa-paper-plane"></i> Take Test</a>
    @endif
    @endif

  </div>
</div>
          </div>
          @endif
          @endforeach

      </div>

    </div>
  </div> 
@endsection
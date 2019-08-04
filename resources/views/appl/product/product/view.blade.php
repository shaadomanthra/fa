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
          </h1>
          <p>
             {!! $obj->description !!} 
          </p>
          <p>
             {!! $obj->details !!} 
          </p>
          @if(\auth::user())
            @if($obj->order(\auth::user()))
            <div class="border p-3 rounded ">
              <i class="fa fa-check-circle text-success"></i> Your service is activated <span class="text-secondary">{{ $obj->order(\auth::user())->created_at->diffForHumans()}}</span>
            </div>
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
                <img src="{{ asset('uploads/'.$obj->image) }}" class="w-100 d-none d-md-block">
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
            @if(count($obj->groups)>2) col-md-6 col-lg-3 @endif
             mb-3">
              <div class="card" >
                @if(file_exists(public_path().'/uploads/'.$group->image) && $group->image)
                   <div class="card-img-top" style="background: linear-gradient(to top, rgba(0, 0, 0,0.3),rgba(255, 255, 255,0.2)), url({{ asset(url('/').'/uploads/'.$group->image)}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;height:100px; padding:25px;padding-top:90px;"> 
</div>
  @endif
  <div class="card-body">
    <h5 class="card-title">{{ $group->name}}</h5>
    <p class="card-text">{!! $group->description !!}</p>
    @foreach($group->tests as $test)
    @if($test->testtype)
    @if($test->status)
    <a href="{{ route('test',$test->slug)}}?product={{$obj->slug}}" class="btn btn-outline-secondary mb-1">{{$test->testtype->name}}</a>
    @endif
    @endif
    @endforeach
  </div>
</div>
          </div>
          @endif
          @endforeach

      </div>
    </div>

     

  </div> 



@endsection
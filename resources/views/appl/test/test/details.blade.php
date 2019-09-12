@extends('layouts.app')
@section('title', $test->name.' - First Academy')
@section('description', $test->details)
@section('keywords', $test->name)

@section('content')
<div  class="row ">
  <div class="col-md-12">
   
   <div class="card  mb-4" >
        <div class="card-body p-5">
          <div class="row">
            <div class="col @if($obj->image) col-md-8 @endif">
               <h1 class="h1 mb-0"> {{ $obj->name }} 
                @can('update',$obj)
                <a href="{{ route('test.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan
          </h1>
          <p>
          {!! $obj->details !!} 
          </p>
          @if(\auth::user())
            @if($order = $obj->order(\auth::user()))
            <div class="border p-3 rounded mb-3">
              <i class="fa fa-check-circle text-success"></i> Your service is activated <span class="text-secondary">{{ $order->created_at->diffForHumans()}}</span>
            </div>

            @if(!\auth::user()->attempt($obj->id))
              <a href="{{ route('test.try',$obj->slug) }}">
                <button class="btn btn-lg btn-success">Try Now</button>
              </a>
            @else
              <a href="{{ route('test.analysis',$obj->slug) }}">
                <button class="btn btn-lg btn-outline-primary"><i class="fa fa-bar-chart"></i> Test Report</button>
              </a>
            @endif

            @else
              @if($obj->price !=0)
              <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
              <a href="{{ route('product.checkout',$obj->slug) }}">
              <button class="btn btn-lg btn-success">Buy Now</button>
              </a>

              @elseif($obj->price===null)

              @else
                <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
              <form method="post" action="{{ route('product.order')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="txn_amount" value="0">
              <input  type="hidden" name="test_id"  value="{{ $obj->id }}">
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
            <div class="col-12  col-md-4">
                <img src="{{ asset('storage/'.$obj->image) }}" class="w-100 d-none d-md-block img-thumbnail">
            </div>
            @endif

          </div>
         

          
        </div>
      </div>

</div>
</div>
@endsection



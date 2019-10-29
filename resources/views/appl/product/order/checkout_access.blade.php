
@extends('layouts.app')
@section('title','Checkout - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')


<div class="card">
    <div class="card-title p-4 bg-light">
      <h4 class="mb-0"><i class="fa fa-cart"></i> Checkout with Access Code</h4>
    </div>
    <div class="card-body">
      
      <div class="mb-4">
      @if(isset($product))
      <div class="text-sm">Product</div>
      <b class="h3 text-primary">{{strip_tags($product->name)}}</b><br>{!! $product->description !!}
      @else
      <div class="text-sm ">Test</div>
      <b class="h3 text-primary">{{$test->name}}</b><br>{!! $test->details !!}
      @endif
      </div>
     


      <form method="post" action="{{ route('product.order')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
       
       <div class="mb-3">
        <input class="form-control" type="text" name="coupon" placeholder="Enter the Coupon Code">
        <input class="form-check-input amount" type="hidden" name="txn_amount" value="0">
        @if(isset($product))
        <input class="form-check-input product" type="hidden" name="product_id"  value="{{ $product->id }}">
        @else
        <input class="form-check-input product" type="hidden" name="test_id"  value="{{ $test->id }}">
        @endif
      </div>
      <button class="btn btn-lg btn-success" type="submit">Submit</button>
      </form>

    </div>
</div>

@endsection           
@extends('layouts.app')
@section('title','My Order - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('myorders') }}">My Orders</a></li>
    <li class="breadcrumb-item">{{ $obj->order_id }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">

    <div class="col-md-12">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-th "></i> {{ $obj->order_id }} 

          </p>
        </div>
      </div>

     
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-md-4"><b>Order ID</b></div>
            <div class="col-md-8">{{ $obj->order_id }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Test </b></div>
            <div class="col-md-8">
              
              @if($obj->test_id)
              <a href="{{ route('test',$obj->test->slug) }}">
                {{ strip_tags($obj->test->name) }} 
              </a>
                @else
                <a href="{{ route('product.view',$obj->product->slug) }}">
                {{ strip_tags($obj->product->name) }} 
              </a>
                @endif
            </div>
          </div>
           <div class="row mb-2">
            <div class="col-md-4"><b>Valid Till </b></div>
            <div class="col-md-8">
              {{date('d M Y', strtotime($obj->expiry))}}
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Txn ID / Coupon / Reference </b></div>
            <div class="col-md-8">
              @if($obj->txn_id)
                {{ $obj->txn_id }}
              @else
              -
              @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Payment Mode </b></div>
            <div class="col-md-8">
              @if($obj->payment_mode)
                {{ $obj->payment_mode }}
              @else
              -
              @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Bank Txn ID  </b></div>
            <div class="col-md-8">
              @if($obj->bank_txn_id)
                {{ $obj->bank_txn_id }}
              @else
              -
              @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Bank Name  </b></div>
            <div class="col-md-8">
              @if($obj->bank_name)
                {{ $obj->bank_name }}
              @else
              -
              @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Txn Amount  </b></div>
            <div class="col-md-8">
                <i class="fa fa-rupee"></i> {{ $obj->txn_amount }}
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Status  </b></div>
            <div class="col-md-8">
                 @if($obj->status==0)
                    <span class="badge badge-warning">Incomplete</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Successful</span>
                  @endif
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Created </b></div>
            <div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
          </div>
        </div>
      </div>

    </div>

     

  </div> 



@endsection
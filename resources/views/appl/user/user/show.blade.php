@extends('layouts.app')
@include('meta.show')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->name }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">

    <div class="col-md-12">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-th "></i> {{ $obj->name }} 

          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
            </span>
            @endcan
          </p>
        </div>
      </div>

     
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-md-4"><b>Name</b></div>
            <div class="col-md-8">{{ $obj->name }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Email</b></div>
            <div class="col-md-8">{{ $obj->email }}

            @if($obj->activation_token==1)
              <span class="text-success"><i class="fa fa-check-circle"></i> </span>
              @else
              <span class="text-secondary"><i class="fa fa-exclamation-circle"></i> </span>
              @endif
            </div>
          </div>
         
          <div class="row mb-2">
            <div class="col-md-4"><b>Phone</b></div>
            <div class="col-md-8">{{$obj->phone}}

              @if($obj->sms_token==1)
              <span class="text-success"><i class="fa fa-check-circle"></i> </span>
              @else
              <span class="text-secondary"><i class="fa fa-exclamation-circle"></i> </span>
              @endif
            </div>
          </div>
          
          <div class="row mb-2">
            <div class="col-md-4"><b>Status</b></div>
            <div class="col-md-8">@if($obj->status==0)
                    <span class="badge badge-danger">Blocked</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Created At</b></div>
            <div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
          </div>
           <div class="row mb-2">
            <div class="col-md-4"><b>Last Login At</b></div>
            <div class="col-md-8">{{ ($obj->lastlogin_at) ? \Carbon\Carbon::parse($obj->lastlogin_at)->diffForHumans() : ' - ' }}</div>
          </div>
        </div>
      </div>

      <div class="row">
      @if(count($obj->tests())>0)
      <div class="col-12 col-md-4">
       <div class="card ">
        <div class="card-body">
          <div class="card-title">
          <h3>Tests</h3>
        </div>
          <div class="table-responsive">
            <table class="table table-striped mb-0 border">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Test</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->tests() as $k=>$test)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td><a href="{{ route('user.test',[$obj->id,$test->id])}}">{{$test->name}}</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      @endif
      @if(count($obj->orders)>0)
        <div class="col-12 col-md">
       <div class="card ">
        <div class="card-body">
          <div class="card-title">
          <h3>Orders</h3>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered mb-0 border">
              <thead>
                <tr class="bg-light">
                  <th scope="col">#</th>
                  <th scope="col" class="w-25">Order ID</th>
                  <th scope="col" >Product</th>
                  <th scope="col" >Coupon</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->orders as $k=>$order)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td><a href="{{ route('order.show',[$order->id])}}">{{$order->order_id}}</a></td>
                      <td>{{$order->product->name}}</td>
                      <td>{{(strlen($order->txn_id)<7 && $order->txn_id)? $order->txn_id : '-'}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      @endif
    </div>


    </div>

     

  </div> 


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This following action is permanent and it cannot be reverted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <form method="post" action="{{route($app->module.'.destroy',$obj->id)}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-danger">Delete Permanently</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
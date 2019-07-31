@extends('layouts.app')

@section('content')

<div class="">
    <div class="row ">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-4">
                <div class="" style="background: linear-gradient(to top, rgba(0, 0, 0,0.4),rgba(0, 0, 0,0.1)), url({{asset('images/dashboard/bg2.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;height:100px; padding:25px;padding-top:90px;"> 
</div>
    <div class="user_container">
        <img src="{{ asset('images/admin/user.png')}}" class="user" />
        </div>
                <div class="card-body pt-0 text-center mb-3">
                    <div class="h4 mb-4 mt-4">Hi, {{ \auth::user()->name}}! </div>
                    <p>Develop a passion for learning. If you do, you will never cease to grow <br><span class="text-secondary">-Anthony J Dangelo</span></p>
                    <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <button class="btn btn-success">Logout</button>
                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    
                    </div>
                    
                </div>
            </div>

      
      <div class="col-12 col-md-6 col-lg-8">
        <div class="row">
          <div class="col-12 col-md-6">
       <div class="card mb-3 mb-md-0">
  <div class="card-header">
    Speaking Evaluation
  </div>
  <div class="card-body">
    <p class="card-text">Get your speaking tasks evaluated by expert trainers.</p>
    <a href="{{ route('product.view','writing-evaluation')}}" class="btn btn-outline-secondary">more details</a>
  </div>
</div>
          </div>

          <div class="col-12 col-md-6">
       <div class="card bg-light">
   <div class="card-header">
    Writing Evaluation
  </div>
  <div class="card-body">
    <p class="card-text">Get your writing tasks evaluated by expert trainers.</p>
    <a href="{{ route('product.view','writing-evaluation')}}" class="btn btn-outline-secondary">more details</a>
  </div>
</div>
          </div>

        </div>
 

<div class="bg-light p-4 rounded mt-4">
    <h3 class="mb-4">My Products <a href="{{ route('myorders') }}"><button class="btn btn-outline-primary btn-sm float-right">My Orders</button></a></h3>
@if(count(auth::user()->orders)!=0)    
  <div class="rounded table-responsive">
<table class="table table-striped mb-0 border">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Type</th>
      <th scope="col">Valid Till</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
      @foreach(auth::user()->orders as $k=>$order)
                 <tr>
                  <th scope="row">{{ $k+1}}</th>
                  <td><a href="{{ route('product.view',$order->product->slug) }}">{{$order->product->name}}</a></td>
                  <td>
                    @if($order->product->price==0)
                      <span class="badge badge-warning">Free</span>
                      @else
                      <span class="badge badge-primary">Premium</span>
                      @endif
                  </td>
                  <td>{{date('d M Y', strtotime($order->expiry))}}</td>
                  <td> 
                    @if(strtotime($order->expiry) > strtotime(date('Y-m-d')))
                      <span class="badge badge-success">Active</span>
                    @else
                      <span class="badge badge-danger">Expired</span>
                    @endif
                  </td>
                </tr>
                @endforeach
  </tbody>
</table>
</div>
@else
  <div class="p-4 rounded border">No Products Purchased</div>
@endif

    </div>

      </div>

             

        </div>
    </div>
</div>
@endsection

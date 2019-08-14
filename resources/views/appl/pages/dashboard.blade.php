@extends('layouts.app')
@section('title', 'First Academy - The best practice tests for IELTS | OET and other tests')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')

<div class="">
  <div class="row ">
    <div class="col-12 col-sm-6 col-md-5 col-lg-4">
      <div class="card mb-4">
        <div class="bg-image" style="background-image: url({{asset('images/dashboard/bg2.jpg')}})"> 
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

  
  <div class="col-12 col-sm-6 col-md-7 col-lg-8">
    <div class="row">
      <div class="col-12 col-md-6">
       <div class="card mb-3 mb-md-0" style="background:rgb(205, 239, 255);border:1px solid #93c4da ;">
        <div class="card-header">
          <b>Speaking Evaluation</b>
        </div>
        <div class="card-body">
          <p class="card-text">Get your speaking tasks evaluated by expert trainers.</p>
          <a href="{{ route('product.view','writing-evaluation')}}" class="btn btn-outline-secondary">more details</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
     <div class="card " style="background:#fffbd6;border:1px solid #bbb89f;">
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


<div class="bg-white border p-4 rounded mt-4">
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

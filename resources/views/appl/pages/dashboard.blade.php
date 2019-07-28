@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-4">
                <div class="" style="background: linear-gradient(to top, rgba(0, 0, 0,0.3),rgba(255, 255, 255,0.4)), url({{asset('images/dashboard/bg3.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
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
        <div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="bg-light p-4 rounded mt-4">
    <h3 class="mb-4">My Products <a href="{{ route('myorders') }}"><button class="btn btn-outline-primary btn-sm float-right">My Orders</button></a></h3>
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
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>

    </div>

      </div>

             

        </div>
    </div>
</div>
@endsection

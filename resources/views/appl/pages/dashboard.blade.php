@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-4">
                <div class="" style="background: linear-gradient(to top, rgba(0, 0, 0,0.3),rgba(255, 255, 255,0.4)), url({{asset('images/dashboard/1.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;height:100px; padding:25px;padding-top:90px;"> 
</div>
                <div class="card-body pt-0">
                    <div class="h4 mb-4 mt-4">OET Practice Test  1 <span class="badge badge-primary text-light">FREE</span></div>
                    <div class="row mb-3  mt-4 no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <a href="{{ route('test','oet_listening_1')}}"><button class="btn btn-lg btn-outline-primary w-100 mb-4 mb-md-0"><i class="fa fa-headphones"></i> Listening</button></a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                            <button class="btn btn-lg btn-outline-success w-100 "><i class="fa fa-book"></i> Reading</button>
                        </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <button class="btn btn-lg btn-outline-secondary w-100 mb-4 mb-md-0"><i class="fa fa-microphone"></i> Speaking</button>
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                          <button class="btn btn-lg btn-outline-danger w-100 "><i class="fa fa-pencil"></i> Writing</button>
                      </div>
                        </div>
                    </div>
                    
                    </div>
                    
                </div>
            </div>

                   
            <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-4 ">
                <div class="" style="background: linear-gradient(to top, rgba(255, 255, 255,0.98),rgba(255, 255, 255,0.2)), url({{asset('images/dashboard/2.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;height:100px; padding:25px;padding-top:150px;"> <div class="h4 mb-4"><span class="text-secondary "> <i class="fa fa-lock"></i> </span>&nbsp;OET Practice Test 2</div>
</div>
                <div class="card-body pt-0">
                    <div class="mt-3 text-muted">
                        <i class="fa fa-calendar"></i> Published on : 25th Aug 2018<br>
                        <i class="fa fa-flash"></i> Test Taken : 35678
                    </div>
                    <div class="row mb-3  mt-4 no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <button class="btn btn-lg btn-outline-primary w-100 mb-4 mb-md-0"><i class="fa fa-headphones"></i> Listening</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                            <button class="btn btn-lg btn-outline-success w-100 "><i class="fa fa-book"></i> Reading</button>
                        </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <button class="btn btn-lg btn-outline-secondary w-100 mb-4 mb-md-0"><i class="fa fa-microphone"></i> Speaking</button>
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                          <button class="btn btn-lg btn-outline-danger w-100 "><i class="fa fa-pencil"></i> Writing</button>
                      </div>
                        </div>
                    </div>
                    
                    </div>
                    
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-4 ">
                <div class="" style="background: linear-gradient(to top, rgba(0, 25, 25,0.4),rgba(255, 255, 255,0.4)), url({{asset('images/dashboard/4.jpg')}}); height: stretch;background-repeat: no-repeat;background-size: auto;
-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; width:100%;height:100px; padding:25px;padding-top:90px;"> 
</div>
                <div class="card-body pt-0">
                    <div class="h4 mb-4 mt-4">OET Practice Test <span class="badge badge-info text-light">#3</span></div>
                    
                    <div class="row mb-3  mt-4 no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <button class="btn btn-lg btn-outline-primary w-100 mb-3 mb-md-0"><i class="fa fa-headphones"></i> Listening</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                            <button class="btn btn-lg btn-outline-success w-100 "><i class="fa fa-book"></i> Reading</button>
                        </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6">
                            <div class="mr-0 mr-md-2">
                            <button class="btn btn-lg btn-outline-secondary w-100 mb-4 mb-md-0"><i class="fa fa-microphone"></i> Speaking</button>
                        </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ml-0 ml-md-2">
                          <button class="btn btn-lg btn-outline-danger w-100 "><i class="fa fa-pencil"></i> Writing</button>
                      </div>
                        </div>
                    </div>
                    
                    </div>
                    
                </div>
            </div>
             

        </div>
    </div>
</div>
@endsection

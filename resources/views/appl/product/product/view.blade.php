@extends('layouts.reading')
@section('content')

  <div class="row">

    <div class="col-md-12">
      <div class="card  mb-3">
        <div class="card-body p-5">
          <h1 class="h1 mb-0"> {{ $obj->name }} 
          </h1>
          <p>
             {!! $obj->description !!} 
          </p>
          @if($obj->price !=0)
          <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
          <button class="btn btn-lg btn-success">Buy Now</button>
          @else
            <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
          @endif
        </div>
      </div>

      <div class="row">
        @foreach($obj->groups as $group)
          <div class="col-12 
            @if(count($obj->groups)==2) col-md-6 col-lg-6 @endif
            @if(count($obj->groups)>2) col-md-6 col-lg-4 @endif
            ">
              <div class="card" >
                @if(file_exists(public_path().'/uploads/'.$group->image) && $group->image)
                   <div class="card-img-top" style="background: linear-gradient(to top, rgba(0, 0, 0,0.3),rgba(255, 255, 255,0.3)), url({{ asset(url('/').'/uploads/'.$group->image)}}); height: stretch;background-repeat: no-repeat;background-size: auto;
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
    <a href="#" class="btn btn-outline-secondary mb-1">{{$test->testtype->name}}</a>
    @endif
    @endforeach
  </div>
</div>
          </div>
          @endforeach

      </div>
    </div>

     

  </div> 



@endsection
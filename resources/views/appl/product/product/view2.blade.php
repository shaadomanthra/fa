@extends('layouts.breadcrumb')

@section('title',$obj->name.' - First Academy' )
@section('description', strip_tags($obj->description))
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET, '.$obj->name)

@section('content')
<div class="p-4 " style="background:#eee;">
<div class=" container ">
    <div class="pb-1">
      <a href="{{ url('/')}}" class="text-secondary">Home</a> 
        &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
      <a href="{{ url('/products')}}" class="text-primary">Products</a> 
    </div>
    <h1 class="h3 mb-0"><b> {{ $obj->name }} </b>
                @can('update',$obj)
                <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan

               <span class="float-right " > {{ count($obj->tests)}}  @if(count($obj->tests)>1)Tests @else Test @endif </span> 
          </h1>
</div>
</div>
<div class="bg-white">
<main class="py-4 container ">

  <div class="row ">

      <div class="col-12 col-md-3">
      
      <div class="card  mb-4" style="background: #fffcd8;border:1px solid #cecaa2;">
        <div class="card-body ">
          <div class="row">
            @if($obj->image)
            <div class="col-12 mb-4">
                <img src="{{ asset('storage/'.$obj->image) }}" class="w-50 d-none d-md-block">
            </div>
            @endif
            <div class="col-12">
               
          <p>
             {!! $obj->description !!} 

          </p>
          
          @if(\auth::user())
            @if($obj->order)
              @if(strtotime($obj->order->expiry) > strtotime(date('Y-m-d')))
              <div class="border p-3 rounded ">
                <i class="fa fa-check-circle text-success"></i> Your service is activated <span class="text-secondary">{{ $obj->order->created_at->diffForHumans()}}</span>
              </div>
              @else
              <div class="border p-3 rounded mb-3">
                <i class="fa fa-times-circle text-danger"></i> Your service is Expired
              </div>

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
            

          </div>
         

          
        </div>
      </div>

    </div>

    <div class="col-12 col-md-9">


<div class="row">
        @foreach($obj->tests as $k=>$test)

      
        @if($test->status)
          <div class="col-12 
            @if(count($obj->tests)>1) col-md-12  @endif
             mb-3 test_block" style="@if($k>2)display:none;@endif">
              <div class="card" style="box-shadow: 2px 3px #f1f7fb;background-image: linear-gradient(#e9f7ff 5%, white 80%,white 15%); ">
      
  <div class="card-body">
    @if($test->status)
    @if(\auth::user())
      @if(!\auth::user()->attempt($test->id))
      <a href="{{ route('test.instructions',$test->slug)}}?product={{$obj->slug}}" class="btn btn-primary mb-1 float-right"><i class="fa fa-paper-plane"></i> Take Test</a>
      @else
        @if($test->testtype->name == 'SPEAKING' || $test->testtype->name == 'WRITING')
        <a href="{{ route('test.try',$test->slug)}}?product={{$obj->slug}}" class="btn btn-secondary mb-1 float-right"><i class="fa fa-eye"></i> View Response</a>
        @else
        <a href="{{ route('test.analysis',$test->slug)}}?product={{$obj->slug}}" class="btn btn-secondary mb-1 float-right"><i class="fa fa-bar-chart"></i> Test Report</a>
        @endif
      @endif
    @else
      <a href="{{ route('test.instructions',$test->slug)}}?product={{$obj->slug}}" class="btn btn-primary mb-1 float-right"><i class="fa fa-paper-plane"></i> Take Test</a>
    @endif
    @endif

    <h4 class="card-title"><i class="fa fa-clone"></i> {{ $test->name}} 

    @if($test->price==0)
    <span class="badge badge-warning">FREE</span>
    @endif
    @can('update',$obj)
      <a href="{{ route('test.edit',$test->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
    @endcan</h4>

    @if($test->marks)
    <div class="">{{$test->marks}} Questions 
      @if($test->test_time)
      | {{$test->test_time}} min
      @endif
    </div>
    @elseif($test->test_time)
    <div class="">{{$test->test_time}} min</div>
    @else
    @endif

    @if($test->level)
    <div class="">
      <B>Level : </B>
      <span class="text-success">
      @for($i=$test->level;$i>0;$i--)
          <i class="fa fa-star "></i>
      @endfor
      </span>
      <span class="text-secondary">
      @for($i=(5-$test->level);$i>0;$i--)
          <i class="fa fa-star-o "></i>
      @endfor
      </span>
    </div>
    @endif

  </div>
</div>
          </div>
          @endif
          @endforeach

          @if($k>2)
          <div class="container">
  <div class="row">
    <div class="col text-center">
      <a href="" class="h5 view-more btn btn-outline-secondary"><b>View more</b></a>
    </div>
  </div>
</div>
          @endif

    @include('appl.product.product.why_these_tests')
        


</div>

  @if(strip_tags($obj->details))
  <div class="">
  <h4>Product Details @can('update',$obj)
                <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan</h4>
  <p>{!! $obj->details !!}</p>
  </div>
  @endif


  <div class="mt-4">
    <h4 class="mb-3">Related Tests</h4>
    <div class="row">
      @if($obj->related_tests)
      @foreach($obj->related_tests as $k=>$t)
      @if($k<4)
      <div class="col-12 col-md-6 mb-3">
        <div class="card"  style="box-shadow: 2px 3px #f1f7fb;background-image: linear-gradient(#ffeef7 5%, white 80%,white 15%);">
          <div class="card-body">
            <h5>{{$t->name}}
                @if($t->price==0)<span class="badge badge-warning">FREE</span>@endif
            </h5>
            <p>
              @if($t->marks){{$t->marks}} Questions | @endif
              @if($t->test_time) {{$t->test_time}} min @endif
              <br>
               @if($test->level)
    <div class="">
      <B>Level : </B>
      <span class="text-success">
      @for($i=$test->level;$i>0;$i--)
          <i class="fa fa-star "></i>
      @endfor
      </span>
      <span class="text-secondary">
      @for($i=(5-$test->level);$i>0;$i--)
          <i class="fa fa-star-o "></i>
      @endfor
      </span>
    </div>
    @endif
            </p>

          <a href="{{ route('test',$t->slug)}}">
            <button class="btn btn-sm btn-success">view</button>
          </a>
          </div>

        </div>
      </div> 
      @endif
      @endforeach
      @endif

    </div>  
  </div>



</div>



    </div>
  </div>
</main>
</div>
@endsection
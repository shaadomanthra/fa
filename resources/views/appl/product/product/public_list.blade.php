
@if($objs->total()!=0)
@foreach($objs as $obj)
<div class="col-12 col-md-6 col-lg-6 mb-4">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title">{{ $obj->name }}
    @if($obj->price!=0)
      <span class="float-right text-secondary"><i class="fa fa-rupee"></i> {{$obj->price}}</span>
    @endif
    </h5>
    @if($obj->price==0)
    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-warning">Free</span></h6>
    @else
    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-primary">PREMIUM</span></h6>
    @endif
    <p class="card-text">
      <hr>
      <div class="row">
        <div class="col-3 ">
          <img src="{{ asset('images/general/document.png')}}" class="w-100 p-2">
        </div>
        <div class="col-9">
          {!!$obj->description!!}
          <a href="{{ route('product.view',$obj->slug)}}" class="btn  btn-outline-primary">Explore</a>
        </div>

      </div></p>
    
  </div>
</div>
</div>
@endforeach
@else
<div class="container">
<div class="card card-body bg-light">
  No {{ $app->module }} found
</div>
</div>
@endif


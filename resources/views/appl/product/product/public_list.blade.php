@if(count($objs)!=0)
@foreach($objs as $obj)
@if($obj->status)
<div class="col-12 col-md-6 col-lg-6 mb-4">
<div class="card " >
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
        @if(\Storage::disk('uploads')->exists($obj->image) && $obj->image )
        <div class="col-3 ">
          <img src="{{ asset('uploads/'.$obj->image) }}" class="w-100 ">
        </div>
        @endif
        <div class="col">
            <p>
              {{ substr(strip_tags($obj->description),0,200 )}}
              @if(strlen(strip_tags($obj->description))>200) ...@endif</p>
          <a href="{{ route('product.view',$obj->slug)}}" class="btn  btn-outline-primary">Explore</a>
        </div>
      </div></p>
  </div>
</div>
</div>
@endif
@endforeach
@else
<div class="container">
<div class="card card-body bg-light">
  No {{ $app->module }} found
</div>
</div>
@endif
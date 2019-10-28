@if(count($objs)!=0)
@foreach($objs as $obj)
@if($obj->status)
<div class="col-6 col-md-4 col-lg-2">
  <div class="card mb-3 ">
    <div class="card-body text-center">
      @if(\Storage::disk('public')->exists($obj->image) && $obj->image )
      <a href="{{ route('product.view',$obj->slug)}}">
      <img src="{{ asset('storage/'.$obj->image) }}" class="w-50 "/>
    </a>
      @endif
    </div>
    <a href="{{ route('product.view',$obj->slug)}}">
    <div class="card-footer text-center text-dark "><b>{!! $obj->name !!}</b></div>
    </a>
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
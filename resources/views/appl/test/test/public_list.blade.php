@if(count($objs)!=0)
@foreach($objs as $obj)
@if($obj->status)
<div class="col-12 col-md-6 col-lg-4 mb-4">
    <div class="card" >
                @if(\Storage::disk('public')->exists($obj->image)  && $obj->image)
         <picture>
  <source srcset="{{ asset('/storage/test/'.$obj->slug.'_300.webp') }} 320w,
             {{ asset('/storage/test/'.$obj->slug.'_600.webp') }}  480w,
             {{ asset('/storage/test/'.$obj->slug.'_900.webp') }}  800w,
             {{ asset('/storage/test/'.$obj->slug.'_1200.webp') }}  1100w" type="image/webp" sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px" alt="{{  $obj->name }}">
  <source srcset="{{ asset('/storage/test/'.$obj->slug.'_300.jpg') }} 320w,
             {{ asset('/storage/test/'.$obj->slug.'_600.jpg') }}  480w,
             {{ asset('/storage/test/'.$obj->slug.'_900.jpg') }}  800w,
             {{ asset('/storage/test/'.$obj->slug.'_1200.jpg') }}  1100w," type="image/jpeg" sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px" alt="{{  $obj->name }}"> 
  <img srcset="{{ asset('/storage/test/'.$obj->slug.'_300.jpg') }} 320w,
             {{ asset('/storage/test/'.$obj->slug.'_600.jpg') }}  480w,
             {{ asset('/storage/test/'.$obj->slug.'_900.jpg') }}  800w,
             {{ asset('/storage/test/'.$obj->slug.'_1200.jpg') }}  1100w,"
      sizes="(max-width: 320px) 280px,
            (max-width: 480px) 440px,
            (max-width: 720px) 800px
            1200px"
      src="{{ asset('/storage/test/'.$obj->slug.'_600.jpg') }} " class="w-100 d-print-none" alt="{{  $obj->name }}">
</picture>
  @endif
  <div class="card-body">
    <h5 class="card-title">{{ $obj->name}} @if(!$obj->price)
       <span class="badge badge-warning">FREE</span>
       @else
       <span class="badge badge-primary">PREMIUM</span>
       @endif
       </h5>
       
    
    <div class="mt-3">
    <a href="{{ route('test',$obj->slug)}}" class="btn btn-outline-secondary mb-1">view</a>
  </div>

  </div>
</div>
</div>
@endif
@endforeach
@else
<div class="container">
<div class="card card-body bg-light">
  No obj found
</div>
</div>
@endif
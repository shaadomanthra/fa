@if(count($objs)!=0)
<div class="row ">
@foreach($objs as $obj)
@if($obj->status)
<div class="col-12 col-md-6 col-lg-6 mb-3">
    <div class="card" >

  <div class="card-body">
  
    <h5 class="card-title">
      <a href="{{ route('test',$obj->slug)}}"><i class="fa fa-clone"></i> {{ $obj->name}}</a>
       @if(!$obj->price)
       <span class="badge badge-warning" style="font-size: 10px;">FREE</span>
       @else
       <span class="badge badge-primary" style="font-size: 10px;">PREMIUM</span>
       @endif
       </h5>
       
    <p class="card-text">
      @if($obj->marks){{$obj->marks}} Questions @endif
      @if($obj->marks && $obj->test_time) | @endif
      @if($obj->test_time) {{$obj->test_time}} min @endif
      <br>
      @if($obj->level)
      <span class="">
        <B>Level : </B>
        <span class="text-success">
          @for($i=$obj->level;$i>0;$i--)
          <i class="fa fa-circle "></i>
          @endfor
        </span>
        <span class="text-secondary">
          @for($i=(5-$obj->level);$i>0;$i--)
          <i class="fa fa-circle-o "></i>
          @endfor
        </span>
      </span>
      @endif
    </p>
    
    


  </div>
</div>
</div>
@endif
@endforeach
</div>
<nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
</nav>

@else
<div class="container">
<div class="card card-body bg-light">
  No tests found
</div>
</div>
@endif

 

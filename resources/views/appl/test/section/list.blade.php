
 @if($objs->total()!=0)

              @foreach($objs as $key=>$obj)  
              

<div class="p-4 rounded bg-white border-left mb-3">
  <div class="">
    <div><h5 class="d-inline"><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  {{ $obj->name }}
                  </a></h5>
                  <span class="float-right"><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</a></span>
    </div>
    <p>{!!$obj->instructions!!}</p>
  </div>
</div>
              @endforeach      

        @else
        <div class="card card-body bg-light">
          No Sections found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>

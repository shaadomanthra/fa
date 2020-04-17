
 @if($objs->total()!=0)

              @foreach($objs as $key=>$obj)

              <div class="p-4 rounded bg-white border-left mb-3">
  <div class="row">
    <div class="col-2 col-md-1">
      <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} " style="font-size:30px;">{{ $obj->sno }}</a></div>
    <div class="col-10 col-md-11">
      <div><h5 class="d-inline"> <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  @if($obj->label )<b> {{$obj->label }}</b> @endif </a></h5>

                </div>
                <div>
                  <p class="d-inline">@if($obj->prefix ) {{$obj->prefix }}  @endif 
                  @if($obj->answer) <u><i >({{$obj->qno}}) {{$obj->answer }}</i> </u> @endif
                  @if($obj->suffix ){{$obj->suffix }}  @endif</p>
<span class="float-right"><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</a></span>
                </div>

                  
    </div>
    
  </div>
</div>  
              
              @endforeach     
        @else
        <div class="card card-body bg-light">
          No {{ $app->module }} found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>

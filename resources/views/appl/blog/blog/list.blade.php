@if(isset($app->name))
  <h1 class="headin"><b>{{ $app->name}}</b></h1>
@endif
<div class="empty {{$i=0}}" ></div>
 @if($objs->total()!=0)
 @foreach($objs as $key=>$obj) 
 @if($obj->status==1)
   @include('appl.'.$app->app.'.'.$app->module.'.schedule')
 @else
  @auth
    @if(\auth::user()->admin)
      @include('appl.'.$app->app.'.'.$app->module.'.schedule')
    @endif
  @endauth
 @endif

  @endforeach
       
        @else
        <div class="card card-body bg-light">
          No blogs found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-4 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>


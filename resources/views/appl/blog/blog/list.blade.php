@if(isset($app->name))
  <h1 class="headin"><b>{{ $app->name}}</b></h1>
@endif

 @if($objs->total()!=0)
 @foreach($objs as $key=>$obj) 
 @if($key!=0)
 <hr>
 @endif
 <div class="mb-4 mt-4">
  <a href=" {{ route('page.view',$obj->slug) }} ">
  <h3>  <b>{{ $obj->title }}</b></h3>
  </a>
  <div class="mt-3"><i class="fa fa-calendar"></i> &nbsp;{{ \Carbon\Carbon::parse($obj->created_at)->format('M d Y') }} &nbsp;&nbsp;

            @if(count($obj->categories)!=0)|&nbsp;&nbsp; Category: 
            @foreach($obj->categories as $cat)
              <span class="badge badge-success">{{$cat->name}}</span>
            @endforeach
            @endif
          </div>
          <div class="body mt-3 mb-4" style="font-size:17px;line-height: 25px">
              {!! substr(strip_tags($obj->body),0,500) !!}
             </div>
             <a href=" {{ route('page.view',$obj->slug) }} ">
             <button class="btn btn-primary btn-lg mb-2">readmore <i class="fa fa-angle-right"></i></button>  
           </a>
</div>

  @endforeach
       
        @else
        <div class="card card-body bg-light">
          No blogs found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-4 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>


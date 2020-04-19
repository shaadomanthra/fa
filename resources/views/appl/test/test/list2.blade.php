
<style>
.bbox{border-top:2px solid #e8eaf3;box-shadow: 1px 2px 2px 1px #e8eaf3;}
.pos{border-radius: 0px 0px 5px 5px; background: #f4f6fb;}
.round_text{text-align: right;font-size:50px; margin-top: -50px;color:#b8d5ef; }
.slug{color: #989ea2}
</style>
 @if($objs->total()!=0)

 <div class="row">
  @foreach($objs as $key=>$obj) 
  <div class="col-12 col-md-4 " data-val="{{ $num = 'c'.rand(0,9)}}">
    <div class="bg-white rounded mb-4 bbox" style="">
      <div class="row">
      @if($obj->image)
            <div class="col-4">
               <img 
      src="{{ asset('/storage/test/'.$obj->slug.'_600.jpg') }} " class="image-thumbnail w-100 d-none d-md-block p-3" alt="{{  $obj->name }}">
            </div>
            @endif
      <div class="col">
        <a href=" {{ route($app->module.'.show',$obj->id) }} ">
        <h4 class="p-3 pt-4">
      {{ $obj->name }} 
    </h4>
  </a>
      </div>

      
      </div>
      <div class="p-3 pos " >
        <div class="row">
          <div class="col-12 col-md-8">
            <div class="slug">{{ $obj->slug }}</div>
      @if($obj->status==0)
                    <span class="badge badge-warning">Inactive</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif

          </div>
           <div class="col-12 col-md-4">
            <div class="round"><div class="round_text">{{ $obj->attemptcount() }}</div></div>

          </div>
        </div>

        
      
    </div>
    
    </div>
  </div>
  @endforeach
  </div>
       
        @else
        <div class="card card-body bg-light">
          No {{ $app->module }} found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>

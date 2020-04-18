
<style>
.round{
  background: #efe6a4;
  color: #a29845;
  width:60px;
  height: 60px;
  border-radius: 50px;
  right:-15px;
  top:-30px;
  border:3px solid #e6dd97;
font-weight: 900;
  position: absolute;
}
.pos{position: relative;border-radius: 0px 0px 5px 5px; background: #e3eef5;}
.round_text{text-align: center;padding-top: 15px; }
.c1{ background: #9A0038 }
.c2{background: #3E005D}
.c3{background: #A70C00}
.c4{background: #1ABC9C}
.c5{ background: #9B59B6 }
.c6{background: #34495E}
.c7{background: #6E3C1B}
.c8{background: #106B60}
.c9{background: #2980B9}
.c0{background: #354546}

.slug{color: #989ea2}
</style>
 @if($objs->total()!=0)

 <div class="row">
  @foreach($objs as $key=>$obj) 
  <div class="col-12 col-md-4 " data-val="{{ $num = 'c'.rand(0,9)}}">
    <div class="bg-white rounded mb-4" style="border-top:2px solid #e3eef5;">
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
        <div class="round"><div class="round_text">{{ $obj->attemptcount() }}</div></div>
      <div class="slug">{{ $obj->slug }}</div>
      @if($obj->status==0)
                    <span class="badge badge-warning">Inactive</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif
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

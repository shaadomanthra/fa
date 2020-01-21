

 
 <div class="mb-4 mt-4 ">
  <a href=" {{ route('page.view',$obj->slug) }} ">
  <h3>  <b>{{ $obj->title }}</b></h3>
  </a>
  <div class="mt-3"><i class="fa fa-calendar"></i> &nbsp;{{ \Carbon\Carbon::parse($obj->created_at)->format('M d Y') }} &nbsp;&nbsp;

            @if(count($obj->categories)!=0)|&nbsp;&nbsp; Category: 
            @foreach($obj->categories as $cat)
             <a href="{{ route('category.list',$cat->slug)}}">
              <span class="badge badge-success">{{$cat->name}}</span>
            </a>
            @endforeach
            @endif

            @if($obj->status==0)
               <span class="badge badge-warning">Draft</span>
            @endif

            @if(\Carbon\Carbon::parse($obj->created_at)->gt(date('Y-m-d H:i:s')))
              <span class="badge badge-secondary">scheduled</span>
            @endif
          </div>
          <div class="body mt-3 mb-4" style="font-size:17px;line-height: 25px">
              {!! substr(strip_tags($obj->body),0,500) !!}
             </div>
             <a href=" {{ route('page.view',$obj->slug) }} ">
             <button class="btn btn-primary btn-lg mb-2">Read more <i class="fa fa-angle-right"></i></button>  
           </a>
</div>

@if($loop->iteration!=$loop->last)
<hr>
@endif


 @if($objs->total()!=0)

              @foreach($objs as $key=>$obj)  

                            <div class="p-4 rounded bg-white border-left mb-3">
  <div class="row">
    <div class="col-2 col-md-1">
      <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} " style="font-size:30px;">{{ $obj->qno }}</a></div>
    <div class="col-10 col-md-11">
      <div>
        <span class="float-right"><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</a></span>
            <h5><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  {!! $obj->question !!}
                  </a></h5>
                  </div>
                   @if($obj->a)
                  <div>
                    @if(strpos($obj->answer, 'A') !== FALSE)
                     <span class="text-success">(A)</span> 
                    @else
                    <span >(A)</span>
                    @endif
                    {!! $obj->a !!}
                  </div>
                  @endif
                   @if($obj->b)
                  <div>
                    @if(strpos($obj->answer, 'B') !== FALSE)
                     <span class="text-success">(B)</span> 
                    @else
                    <span >(B)</span>
                    @endif
                    {!! $obj->b !!}
                  </div>
                  @endif
                  @if($obj->c)
                  <div>
                    @if(strpos($obj->answer, 'C') !== FALSE)
                     <span class="text-success">(C)</span> 
                    @else
                    <span >(C)</span>
                    @endif
                    {!! $obj->c !!}
                  </div>
                  @endif

                  @if($obj->d)
                  <div>
                    @if(strpos($obj->answer, 'D') !== FALSE)
                     <span class="text-success">(D)</span> 
                    @else
                    <span >(D)</span>
                    @endif
                    {!! $obj->d !!}
                  </div>
                  @endif

                  @if($obj->e)
                  <div>
                    @if(strpos($obj->answer, 'E') !== FALSE)
                     <span class="text-success">(E)</span> 
                    @else
                    <span >(E)</span>
                    @endif
                    {!! $obj->e !!}
                  </div>
                  @endif

                  @if($obj->f)
                  <div>
                    @if(strpos($obj->answer, 'F') !== FALSE)
                     <span class="text-success">(F)</span> 
                    @else
                    <span >(F)</span>
                    @endif
                    {!! $obj->f !!}
                  </div>
                  @endif

                  @if($obj->g)
                  <div>
                    @if(strpos($obj->answer, 'G') !== FALSE)
                     <span class="text-success">(G)</span> 
                    @else
                    <span >(G)</span>
                    @endif
                    {!! $obj->g !!}
                  </div>
                  @endif

                  @if($obj->h)
                  <div>
                    @if(strpos($obj->answer, 'H') !== FALSE)
                     <span class="text-success">(H)</span> 
                    @else
                    <span >(H)</span>
                    @endif
                    {!! $obj->h !!}
                  </div>
                  @endif

                  @if($obj->i)
                  <div>
                    @if(strpos($obj->answer, 'I') !== FALSE)
                     <span class="text-success">(I)</span> 
                    @else
                    <span >(I)</span>
                    @endif
                    {!! $obj->i !!}
                  </div>
                  @endif
               

                  
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

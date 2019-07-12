
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col" style="width: 8%">Qno</th>
                <th scope="col">Question </th>
                <th scope="col" style="width: 20%">Extract</th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">{{ $obj->qno }}</th>
                <td>
                  <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  {!! $obj->question !!}
                  </a>
                  <div>
                  @if($obj->answer=='A')
                   <span class="text-success">(A)</span> 
                  @else
                  <span >(A)</span>
                  @endif
                  {{ $obj->a }}
                  </div>
                  <div>
                  @if($obj->answer=='B')
                   <span class="text-success">(B)</span> 
                  @else
                  <span >(B)</span>
                  @endif
                  {{ $obj->b }}
                  </div>
                  <div>
                  @if($obj->answer=='C')
                   <span class="text-success">(C)</span> 
                  @else
                  <span >(C)</span>
                  @endif
                  {{ $obj->c }}
                  </div>

                </td>
                <td>
                  <a href="{{ route('extract.show',[$app->test->id,$obj->extract->id]) }}">
                  {{ $obj->extract->name }}
                  </a>
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No {{ $app->module }} found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>

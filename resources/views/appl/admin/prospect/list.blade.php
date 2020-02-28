
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#({{$objs->total()}})</th>
                <th scope="col">@sortablelink('name') </th>
                <th scope="col">@sortablelink('source','Source')</th>
                <th scope="col">@sortablelink('center')</th>
                <th scope="col">@sortablelink('stage')</th>
                <th scope="col">Followup</th>
                <th scope="col">@sortablelink('created_at','Created') </th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  <a href=" {{ route($app->module.'.show',$obj->id) }} ">
                  {{ $obj->name }}
                  </a>
                </td>
                <td>
                 {{ ucfirst($obj->source) }}
               
                </td>
                <td>
                  {{ ucfirst($obj->center) }}
                </td>
                <td>
                  @if($obj->stage=='enquiry')
                  <span class="badge badge-warning">{{ $obj->stage }}</span>
                  @elseif($obj->stage=='demo')
                  <span class="badge badge-primary">{{ $obj->stage }}</span>
                  @else
                  <span class="badge badge-success">{{ $obj->stage }}</span>
                  @endif
                </td>

                <td>{{ count($obj->followups) }}</td>
                <td>{{ ($obj->created_at) ? $obj->created_at->toDateString() : '' }}</td>
                
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

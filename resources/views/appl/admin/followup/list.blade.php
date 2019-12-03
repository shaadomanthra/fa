
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#({{$objs->total()}})</th>
                <th scope="col">Prospect Name </th>
                <th scope="col">Counsellor </th>
                <th scope="col">Comment</th>
                <th scope="col">Call Scheduled for</th>
                <th scope="col">Created </th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">
                   <a href=" {{ route($app->module.'.show',$obj->id) }} ">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</a></th>
                <td>
                  @if(isset($obj->prospect))
                  <a href=" {{ route('prospect.show',$obj->prospect_id) }} ">
                  {{ $obj->prospect->name }}
                  </a>
                  @endif
                </td>
                <td>
                  {{ $obj->user->name }}
                 
                </td>
                <td>
                 {{ $obj->comment }}
               
                </td>
                <td>
                  {{ $obj->schedule }}
                </td>
                <td>{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</td>
                
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


 
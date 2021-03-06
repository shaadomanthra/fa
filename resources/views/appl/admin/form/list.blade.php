
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Subject</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <tbody {{ $i=1}}>
              @foreach($objs as $key=> $obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  <a href="{{ route('form.show',$obj->id)}}">
                  {{ $obj->name }}
                  </a>
                  
                </td>
                <td>
                  {{ $obj->subject }}
                </td>
                <td>
                  {{ $obj->email }}

                </td>
                <td>
                  {{ $obj->phone }}

                </td>
                <td>@if($obj->status==0)
                  <span class="badge badge-warning">Open</span>
                  @elseif($obj->status==1)
                  <span class="badge badge-primary">Closed</span>
                  @endif</td>
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
        

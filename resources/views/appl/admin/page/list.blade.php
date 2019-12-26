
 @if($objs)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">slug</th>
                <th scope="col">status</th>
                <th scope="col">created by</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <tbody {{ $i=1}}>
              @foreach($objs as $i=> $obj)  
              <tr>
                <th scope="row">{{ ($i+1) }}</th>
                <td>
                  <a href="{{ route('page.view',$obj->slug)}}">
                  {{ $obj->title }}
                  </a>
                  
                </td>
                <td>
                  {{$obj->slug}}
                </td>
                <td>
                  @if($obj->status==0)
                  <span class="badge badge-warning">Inactive</span>
                  @elseif($obj->status==1)
                  <span class="badge badge-primary">Active</span>
                  @endif
                </td>
                <td>
                  {{ $obj->user->name }}

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
        

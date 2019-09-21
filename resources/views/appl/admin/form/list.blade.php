
 @if($objs)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Created</th>
              </tr>
            </thead>
            <tbody {{ $i=1}}>
              @foreach($objs as $i=> $obj)  
              <tr>
                <th scope="row">{{ ($i+1) }}</th>
                <td>
                  <a href="{{ route('form.show',$obj->id)}}">
                  {{ $obj->name }}
                  </a>
                  
                </td>
                <td>
                  {{ $obj->email }}

                </td>
                <td>
                  {{ $obj->phone }}

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
        

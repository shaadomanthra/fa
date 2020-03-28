
 @if(count($obj->sessions))
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 60%">Session </th>
                <th scope="col" style="width: 10%">Participants</th>
                <th scope="col" style="width: 20%">Created </th>
                <th scope="col" style="width: 20%">Status </th>
              </tr>
            </thead>
            <tbody>
              @foreach($obj->sessions()->orderBy('id','desc')->get() as $key=>$o)  
              <tr>
                <th scope="row">{{ $key+1}} </th>
                <td>
                  
                  <a href=" {{ route('session.show',[$obj->slug,$o->slug]) }} ">
                  <h5 class="mb-0">{{ $o->name }} <span class="badge badge-primary">{{$o->slug}}</span></h5>

                  </a>

                </td>
                <td>
                  {{count($o->users)}}
                </td>
                <td>{{ ($o->created_at) ? $o->created_at->format('d-m-Y') : '' }}</td>
                <td>
                  @if($o->status==0)
                    <span class="badge badge-secondary">Closed</span>
                  @elseif($o->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No sessions found
        </div>
        @endif
       

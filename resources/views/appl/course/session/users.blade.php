
 @if(count($obj->users))
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col" style="width: 5%">#({{count($obj->users)}})</th>
                <th scope="col" style="width: 10%">Idno </th>
                <th scope="col" style="width: 40%">Name </th>
                <th scope="col" style="width: 40%">Email</th>
                <th scope="col" style="width: 5%">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($obj->users as $key=>$o)  
              <tr>
                <th scope="row">{{ $key+1 }}</th>
                <th scope="row">{{ $o->idno }}</th>
                <td>
                  
                  <a href=" {{ route('user.show',$o->id) }} ">
                  <div class="mb-0">{{ $o->name }}</div>
                  </a>
                </td>
                <td>
                  {{ $o->email }}
                </td>
                <td>
                  @if(is_numeric(substr($o->idno,1,1)))
                    <span class="badge badge-info text-white">Enrolled </span>
                  @else
                  -
                    @endif
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No participants found
        </div>
        @endif
        
      </nav>

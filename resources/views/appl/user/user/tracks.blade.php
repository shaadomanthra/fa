@if(count($obj->sessions)>0)
       <div class="card mt-3 ">
        <div class="card-body">
          <div class="card-title">
          <h3>Sessions</h3>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered mb-0 border">
              <thead>
                <tr class="bg-light">
                  <th scope="col">#</th>
                  <th scope="col" >Session</th>
                  <th scope="col" class="w-25">Track</th>
                  <th scope="col" >Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->sessions()->orderBy('id','desc')->get() as $k=>$ses)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td>
                        {{$ses->name}}
                      </td>
                      <td>{{$ses->track->name}}</td>
                      <td>{{$ses->created_at->format('d-m-Y')}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @endif
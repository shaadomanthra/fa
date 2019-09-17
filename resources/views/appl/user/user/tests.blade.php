 @if(count($obj->tests())>0)
       <div class="card ">
        <div class="card-body">
          <div class="card-title">
          <h3>Tests</h3>
        </div>
          <div class="table-responsive">
            <table class="table table-striped mb-0 border">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Test</th>
                  <th scope="col">Score</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->tests() as $k=>$test)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td><a href="{{ route('user.test',[$obj->id,$test->id])}}">{{$test->name}}</a></td>
                      <td>{{ $obj->testscore($obj->id,$test->id) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @endif
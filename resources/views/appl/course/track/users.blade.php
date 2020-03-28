
 @if(count($obj->users))
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 10%">Idno </th>
                <th scope="col" style="width: 30%">Name</th>
                <th scope="col" style="width: 20%">Phone </th>
                <th scope="col" style="width: 20%">Email </th>
              </tr>
            </thead>
            <tbody>
              @foreach($obj->users()->orderBy('id','desc')->get() as $key=>$o)  
              <tr>
                <th scope="row">{{ $key+1}} </th>
                <td>
                  {{$o->idno}}
                </td>
                <td>
                  <a href=" {{ route('user.show',[$o->id]) }} ">
                  <div class="mb-0">{{ $o->name }} </div>
                  </a>
                </td>
                <td>{{ ($o->phone) }}</td>
                <td>
                    {{ ($o->email) }}
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No Users found
        </div>
        @endif
       

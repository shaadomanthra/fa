
 @if($objs)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Value</th>
              </tr>
            </thead>
            <tbody {{ $i=1}}>
              @foreach($objs->groupBy('name') as $key=>$obj)  
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>
                  
                  {{ $key }}
                  
                </td>
                <td>
                  @foreach($obj as $m=> $a)
                  @if($m==0)
                  <a href="{{ route($app->module.'.show',$a->id) }}">
                    {{ $a->value }} ({{(count($a->fillup)+count($a->mcq))}})
                  </a>

                  @else
                  , <a href="{{ route($app->module.'.show',$a->id) }}">
                    {{ $a->value }}({{(count($a->fillup)+count($a->mcq))}})
                  </a>
                  @endif

                  @endforeach

                </td>
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
        

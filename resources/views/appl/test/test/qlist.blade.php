
 @if(count($data))
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>

                <th scope="col" style="width: 8%">Sno</th>
                <th scope="col" style="width: 8%">Qno</th>
                <th scope="col">Question </th>
                <th scope="col" style="width: 20%">Extract/Section</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key=>$obj)  
              <tr>
                <th scope="row">
                 @if($obj->mcq_id)
                  <a href=" {{ route('mcq.show',[$test->id,$obj->id]) }} ">
                 @else
                  <a href=" {{ route('fillup.show',[$test->id,$obj->id]) }} ">
                 @endif   
                    {{ $obj->sno }}</a></th>
                <th scope="row">{{ $obj->qno }}</th>
                <td>
                @if($obj->mcq_id)
                  @include('appl.test.test.blocks.mcq')
                @else
                   @include('appl.test.test.blocks.fillup')
                @endif
                 

                </td>
                <td>
                  @if($obj->extract_id)
                  Extract :<br>
                  <a href="{{ route('extract.show',[$app->test->id,$obj->extract_id]) }}">
                    @if(isset($obj->extract))
                  {{ $obj->extract->name }}
                  @endif
                  </a>
                  @elseif($obj->section_id)
                  Section: <br>
                   <a href="{{ route('section.show',[$app->test->id,$obj->section_id]) }}">
                  {{ $obj->section->name }}
                  </a>
                  @endif
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No questions found
        </div>
        @endif
        

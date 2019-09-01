
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">Sno</th>
                <th scope="col">Label  </th>
                <th scope="col">Prefix/Answer/Suffix</th>
                <th scope="col">Extract/Section</th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row"><a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">{{ $obj->sno }}</a></th>
                <td class="w-25">
                  <a href=" {{ route($app->module.'.show',[$app->test->id,$obj->id]) }} ">
                  @if($obj->label )<b> {{$obj->label }}</b> @endif </a>
                 
                </td>
                <td>@if($obj->prefix ) {{$obj->prefix }}  @endif 
                  @if($obj->answer) <u><i >({{$obj->qno}}) {{$obj->answer }}</i> </u> @endif
                  @if($obj->suffix ){{$obj->suffix }}  @endif </td>
                <td class="w-25">
                   @if($obj->extract_id)
                  Extract :<br>
                  <a href="{{ route('extract.show',[$app->test->id,$obj->extract->id]) }}">
                  {{ $obj->extract->name }}
                  </a>
                  @elseif($obj->section_id)
                  Section: <br>
                   <a href="{{ route('section.show',[$app->test->id,$obj->section->id]) }}">
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
          No {{ $app->module }} found
        </div>
        @endif
        <nav aria-label="Page navigation  " class="card-nav @if($objs->total() > config('global.no_of_records'))mt-3 @endif">
        {{$objs->appends(request()->except(['page','search']))->links()  }}
      </nav>

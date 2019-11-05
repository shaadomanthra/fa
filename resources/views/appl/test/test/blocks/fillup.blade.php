@if($obj->label )<b class="text-success"> {{$obj->label }}</b> <br>@endif
@if($obj->prefix ) {{$obj->prefix }}  @endif 
@if($obj->answer) <u><i >({{$obj->qno}}) {{$obj->answer }}</i> </u> @endif
@if($obj->suffix ){{$obj->suffix }}  @endif 
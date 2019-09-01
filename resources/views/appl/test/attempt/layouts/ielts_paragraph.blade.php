<span class="card-text question" id="{{$f->qno}}">
  @if($f->label ) <div><b>{{$f->label }}</b></div>  @endif 
  @if($f->prefix ) {{$f->prefix }}  @endif 
  @if($f->answer) <span class="badge badge-warning h2">{{$f->qno}}</span><input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" >
  @endif
  @if($f->suffix ){{$f->suffix }}@endif
</span>
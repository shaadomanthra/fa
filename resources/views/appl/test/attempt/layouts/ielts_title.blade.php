<div class="row question">
  <div class="col-12 " id="{{$f->qno}}">
    <div class="card-text " ><b>{{ $f->label}}</b>
    </div>
  </div>
  <div class="col-12 ">
    <div class="card-text">
    @if($f->layout == 'default' ||  !$f->layout)
      @if($f->prefix ) {!!$f->prefix !!}  @endif 
      @if($f->answer) <span class="badge badge-warning h2">{{$f->qno}}</span><input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" @if(strlen($f->answer)>20) style="width:300px" @endif>
      @endif
      @if($f->suffix ){!! $f->suffix !!}@endif
    @elseif($f->layout == 'ielts_number' )
      @if($f->prefix ) {!!$f->prefix !!}  @endif 
      @if($f->answer) <span class="badge badge-warning h2">{{$f->qno}}</span><input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" @if(strlen($f->answer)>20) style="width:300px" @endif>
      @endif
      @if($f->suffix ){!! $f->suffix !!}@endif
    @elseif($f->layout=='ielts_two_blank')
      <span class="badge badge-warning h2">{{$f->qno}}</span>
      @include('appl.test.attempt.layouts.ielts_two_blank') 
    @endif
    </div>
  </div>
</div>
<span class="question " id="{{$f->qno}}">
      @if($f->prefix ) {!! $f->prefix !!}  @endif 
      @if($f->answer)
      &nbsp;
      <span style="display:inline-block;">
      <input class="form-control droppable" name="{{$f->qno}}" data-id="{{$f->qno}}"value="">
      
    </span>
      &nbsp; 
      @endif
      @if($f->suffix ){!! $f->suffix !!} @endif
</span>
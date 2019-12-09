<span class="question " id="{{$f->qno}}">
      @if($f->prefix ) {!! $f->prefix !!}  @endif 
      @if($f->answer)
      &nbsp;
      <span style="display:inline-block;">
      <span class="badge badge-warning h2">{{$f->qno}}</span>
      <select class=" input fill" name="{{$f->qno}}" data-id="{{$f->qno}}">
      <option value=""></option>
      @foreach(explode('/',$f->label) as $option)
      <option value="{{ trim($option) }}">{{$option}}</option>
      @endforeach   
      </select>
    </span>
      &nbsp; 
      @endif
      @if($f->suffix ){!! $f->suffix !!} @endif
</span>
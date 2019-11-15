<div class="row question ">
  <div class="col-12 col-md-1" id="{{$f->qno}}">
    <div class="card-text mb-3" ><span class="badge badge-warning h2">{{$f->qno}}</span>
    </div>
  </div>
  <div class="col-12 col-md-11">
    <div class="card-text">
    <span class="question " id="{{$f->qno}}">
      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer)
      &nbsp;
      <span style="display:inline-block;">
      <select class=" input fill" name="{{$f->qno}}" data-id="{{$f->qno}}">
      <option value=""></option>
      @foreach(explode('/',$f->label) as $option)
      <option value="{{ trim($option) }}">{{$option}}</option>
      @endforeach   
      </select>
    </span>
      &nbsp; 
      @endif
      @if($f->suffix ){{$f->suffix }} @endif
    </span>

    </div>
  </div>
</div>
<div class="row question">
  <div class="col-12 " id="{{$f->qno}}">
    <div class="card-text " ><span class="badge badge-warning h2">{{$f->qno}}</span> &nbsp;<b>{{ $f->label}}</b>
    </div>
  </div>
  <div class="col-12 ">
    <div class="card-text"><div>
      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer) <input type="hidden" class="fill input sentence_input" name="{{$f->qno}}" data-id="{{$f->qno}}" >
      <textarea class="form-control sentence_textarea" rows="3" disabled></textarea> 
      @endif
      @if($f->suffix ){{$f->suffix }}@endif
    </div>
  </div>
</div>
</div>
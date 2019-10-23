<div class="row question ">
  <div class="col-12 ">
    <div class="card-text"><div>
      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer) <input type="text" class="fill input" name="{{$f->qno}}" data-id="{{$f->qno}}" >
      @endif
      @if($f->suffix ){{$f->suffix }}@endif
    </div>
  </div>
</div>
</div>
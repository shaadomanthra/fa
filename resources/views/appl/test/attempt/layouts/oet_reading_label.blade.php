<div class="row question ">
  <div class="col-2 col-md-2 col-lg-1" >
    <div class="card-text mb-3" ><b><span class="badge badge-warning h2">{{$f->qno}}</span> </b>
    </div>
  </div>
  <div class="col-9 col-md-10 col-lg-6" id="{{$f->qno}}">
    <div class="card-text mb-3" ><b> {{ $f->label}}</b>
    </div>
  </div>
  <div class="col-12 col-md-12 col-lg-5">
    <div class="card-text mb-3 mb-lg-0"><div>
      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer) <input type="text" class="fill input w-100" name="{{$f->qno}}" data-id="{{$f->qno}}" >
      @endif
      @if($f->suffix ){{$f->suffix }}@endif
    </div>
  </div>
</div>
</div>
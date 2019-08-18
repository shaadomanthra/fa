<div class="p-3 mb-3 rounded bg-light " style="border:1px solid #d8dbde">
<h4>Example</h4>
<div class="row question">

  <div class="col-12 col-md-4" id="{{$f->qno}}">
    <div class="card-text " ><b>{{ $f->label}}</b>
    </div>
  </div>
  <div class="col-12 col-md-8">
    <div class="card-text">


    <div>
      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer) <input type="text" class="fill input mb-0"  value="{{$f->answer}}" disabled>
      @endif
      @if($f->suffix ){{$f->suffix }}@endif
    </div>
  </div>
</div>
</div>
</div>
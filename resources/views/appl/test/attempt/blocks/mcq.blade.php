@foreach($extract->mcq_order as $k=>$m)
@if($k!=0)<hr>@endif
<div class="mb-3">
    <div class="row">
        <div class="col-4 col-md-3 col-lg-2">
          <div id="{{$m->qno}}" class="qno">{{$m->qno}}</div>
      </div>
      <div class="col-12 col-md-9 col-lg-10">
          <div class="question">{!! $m->question !!}</div>
      </div>
  </div>
  <div class="row">
    <div class="col-3 col-md-3 col-lg-2">
      <div class="op"><input class
        ='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> <span class="mt-2">A</span></div>
    </div>
    <div class="col-9 col-md-9 col-lg-10">
      <div class="option">{!! $m->a !!}</div>
  </div>
</div>
@if($m->b )
<div class="row">
    <div class="col-3 col-md-3 col-lg-2">
      <div class="op"><input class
        ='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="B"/> <span class="mt-2">B</span></div>
    </div>
    <div class="col-9 col-md-9 col-lg-10">
      <div class="option">{!! $m->b !!}</div>
  </div>
</div>
@endif 

@if($m->c )
<div class="row">
    <div class="col-3 col-md-3 col-lg-2">
      <div class="op"><input class
        ='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> <span class="mt-2">C</span></div>
    </div>
    <div class="col-9 col-md-9 col-lg-10">
      <div class="option">{!! $m->c !!}</div>
  </div>
</div>
@endif
@if($m->d )
<div class="row">
    <div class="col-3 col-md-3 col-lg-2">
      <div class="op"><input class
        ='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="D"/> <span class="mt-2">D</span></div>
    </div>
    <div class="col-9 col-md-9 col-lg-10">
      <div class="option">{!! $m->d !!}</div>
  </div>
</div>
@endif
</div>            
@endforeach
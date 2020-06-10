<div class="row question">
  <div class="col-12 " id="{{$f->qno}}">
    <div class="py-4 text-center duo-heading"><b>Select the real English words in this list</b></div>
    <div class="card-text row" >
      @foreach(explode('/',$f->label) as $k=>$l)
      <div class="col-6 col-md-2">
      <div class="rounded p-2 select_word text-center" data-subid="{{$f->qno}}_{{$k}}">
        {{ $l}}
        <input type="checkbox" class="{{$f->qno}}_{{$k}}" name="{{$f->qno}}[]" data-id="{{$f->qno}}" data-subid="{{$f->qno}}_{{$k}}" value="{{$l}}" style="display:none">
      </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
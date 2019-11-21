
<div class="p-3 mb-3 rounded  " style="border:1px solid #8bced6;background:#f9fdfd">
<h4><b>Example</b></h4>
<div class="row question">

@if($f->layout!='ielts_two_blank')
  @if($f->label)
  <div class="col-12 col-md-4" id="{{$f->qno}}">
    <div class="card-text " ><b>{{ $f->label}}</b></div>
  </div>
 @endif
  <div class="col-12 col-md">

      @if($f->prefix ) {{$f->prefix }}  @endif 
      @if($f->answer) 
      <input type="text" class="fill input mb-0"  value="{{$f->answer}}" disabled>
      @endif
      @if($f->suffix ){{$f->suffix }}@endif
    
  </div>
@else

<div class="col-12 col-md">
@if($f->prefix ) {{$f->prefix }}  @endif 
@if($f->answer) <input type="text" class="fill input" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value="<?php echo get_string_before($f->answer) ?>">
  <?php echo get_string_between($f->answer,'[',']') ?>
<input type="text" class="fill input" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value="<?php echo get_string_after($f->answer) ?>">
@endif
@if($f->suffix ){{$f->suffix }}@endif
</div>

@endif
</div>
</div>

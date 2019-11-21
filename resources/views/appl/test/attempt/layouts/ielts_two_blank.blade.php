@if($f->prefix ) {!! $f->prefix !!}  @endif 
@if($f->answer) <input type="text" class="fill input" name="{{$f->qno}}[]" data-id="{{$f->qno}}" >
	<?php echo get_string_between($f->answer,'[',']') ?>
<input type="text" class="fill input" name="{{$f->qno}}[]" data-id="{{$f->qno}}" >
@endif
@if($f->suffix ){!! $f->suffix !!}@endif
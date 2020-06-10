
@if($f->label ) <div class="h5 text-center"><b>{{$f->label }}</b></div>  @endif 
<div class="row question ">
  <div class="col-12 col-md-8">
  	<div class="mb-4  mt-3 bg-light p-4 border">
	
	<textarea class="summernote4" name="{{$f->qno}}"></textarea>
	
		<div class=" mt-1 text-secondary"><span class="word-count">0</span> words</div>
</div>
  </div>
</div>
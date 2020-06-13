<div class="pt-3 pb-5 text-center duo-heading"><b>Type the statement that you hear</b></div>

<div class="row question ">
<div class="col-6 col-md-3">

@if(\Storage::disk('public')->exists('extracts/'.$f->id.'_q.mp3') )
    <div id="playerContainer_q" class="cplayer mb-3" data-src="{{ asset('/storage/extracts/'.$f->id.'_q.mp3') }}"></div>
    @endif

</div>
  <div class="col-12 col-md">
  	<div class="mb-4 ">
	
	<textarea class="summernote4" name="{{$f->qno}}" data-id="{{$f->qno}}" ></textarea>
	
</div>
  </div>
</div>
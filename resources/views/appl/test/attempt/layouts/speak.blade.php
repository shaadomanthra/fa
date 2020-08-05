
@if(\Storage::disk('public')->exists('extracts/'.$f->id.'_q.mp3') )
<div class="pt-3 pb-5 text-center duo-heading"><b>Speak the answer to the question you hear</b></div>

@elseif(\Storage::disk('public')->exists('extracts/'.$f->id.'_q_300.jpg')) 
<div class="pt-3 pb-5 text-center duo-heading"><b> Describe aloud the image below</b></div>
@elseif($f->label ) <div class="pt-3 pb-5 text-center duo-heading"><b>Record yourself saying the statement below:</b></div> @elseif($f->prefix)
<div class="pt-3 pb-5 text-center duo-heading"><b>Speak for atleast 30 seconds to the below question</b></div>
@endif

<div style="max-width: 600px;margin: 0px auto;">
<div class="row question ">
	@if($f->label && !\Storage::disk('public')->exists('extracts/'.$f->id.'_q.mp3') && !\Storage::disk('public')->exists('extracts/'.$f->id.'_q_300.jpg'))
<div class="col-3 col-md-2">
	<img src="{{ asset('images/tests/record.png') }}" class="w-100" />
</div>
@endif
<div class="col ">
@if(\Storage::disk('public')->exists('extracts/'.$f->id.'_q.mp3') )
<div id="playerContainer_{{$s}}" class="cplayer mb-3" data-src="{{ asset('/storage/extracts/'.$f->id.'_q.mp3') }}"></div>
    <span class=""></span>
@elseif(\Storage::disk('public')->exists('extracts/'.$f->id.'_q_300.jpg')) 
<div class="text-center">
<div class="img_container mb-3" style="background-image: url('{{ asset('/storage/extracts/'.$f->id.'_q_300.jpg') }}');margin:0px auto;"></div>
</div>
@elseif($f->label ) <div class="h5 mt-3">{{$f->label }}</div> 
@elseif($f->prefix)
<div class="border rounded p-3 mt-3">{!! $f->prefix !!}</div> 

@endif 
</div>
  
</div>
</div>

<div class="sticky-top p-2   mb-3 plyr-bg " >
	<div class="p-1">
		<h5><span class="trackname">{{$test->name}}
		</span></h5>
	</div>
	<div class="">
		<audio >
		<source id="player"  src="{{ url('/').'/uploads/'.$test->file }}" type="audio/mp3">
		</audio>
	</div>
</div>

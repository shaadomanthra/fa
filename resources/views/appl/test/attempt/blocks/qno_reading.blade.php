<div class="bottom-qno">

<div class="bottom-wrap">
    <div class="pallete qshow mb-0 h5 pb-0"><span class="pallete-control"><i class="fa fa-th"></i> Questions  <span class="angle"><i class="fa fa-angle-double-down"></i></span></span>
    @if(!isset($view))
     <button class="btn btn-outline-light btn-sm ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Submit</button>
     @endif
     <span class="badge badge-warning float-right" id="timer"></span>
    	<span class="badge badge-warning float-right d-none" id="timer2">00:00</span></div>
<div class="pt-2 bottom-scroll {{$i=1}}"> 
@foreach($test->sections as $section)
<div class="bottom-box  text-center">
<div class="sno bottom-pno  s{{$section->id}}" data-id="{{$section->id}}">P{{$i++}}</div>
</div>
@foreach($section->extracts as $extract)
	@foreach($extract->mcq as $m)
<div class="bottom-box  text-center">
<div class="sno bottom-sno  s{{$m->qno}}" data-id="{{$m->qno}}">{{$m->qno}}</div>
</div>
	@endforeach
	@foreach($extract->fillup as $m)
<div class="bottom-box  text-center">
<div class="sno bottom-sno  s{{$m->qno}}" data-id="{{$m->qno}}">{{$m->qno}}</div>
</div>
	@endforeach
	@endforeach   
	@endforeach

</div>
</div>
</div>
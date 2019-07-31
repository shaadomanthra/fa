<div class="bottom-qno">

<div class="bottom-wrap">
    <div class="pallete qshow mb-0 h5"><span class="pallete-control"><i class="fa fa-th"></i> Questions Pallete </span>
    @if(!isset($view))
     <button class="btn btn-outline-light btn-sm ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Submit</button>
     @endif
     <span class="badge badge-warning float-right" id="timer"></span>
    	<span class="badge badge-warning float-right d-none" id="timer2">00:00</span></div>
<div class="bottom-scroll">    
@for($i=1;$i <= 40; $i++ ) 
<div class="bottom-box  text-center">
<div class="sno bottom-sno  s{{$i}}" data-id="{{$i}}">{{$i}}</div>
</div>
@endfor
</div>
</div>
</div>
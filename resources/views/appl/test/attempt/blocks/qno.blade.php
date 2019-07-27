
<div class="sticky-top d-none d-sm-block">
<div class=" p-4  sidebar ">
<h5 class="mb-4 "><i class="fa fa-th"></i> Questions Pallete &nbsp;<span class="badge badge-warning float-right" id="timer2">40:00</span></h5>
<div class="row no-gutters">
@for($i=1;$i <= $qcount; $i++ ) 
<div class="col-2">
<div class="box pr-2 pb-2 text-center">
<div class="sno s{{$i}}" data-id="{{$i}}">{{$i}}</div>
</div>
</div>
@endfor
</div>
<div class="mt-3">
	<span class="answered-spot"><i class="fa fa-circle "></i> </span>Answered &nbsp;<span class="unanswered"> <i class="fa fa-circle "></i> </span>Unanswered
	</div>
<button class="btn btn-outline-light mt-4" type="button" data-toggle="modal" data-target="#exampleModal">Submit Test</button>
</div>
</div>

<div class="d-block d-sm-none" style="position:fixed;bottom:0;left:0;right:0">
<div class=" p-4  sidebar ">
<h4 class="mb-0 qshow"><i class="fa fa-th"></i> Questions Pallete <span class="badge badge-warning" id="timer">40:00</span></h4>
<div class="qdata mt-4">
<div class="row no-gutters">
@for($i=1;$i <= $qcount; $i++ ) 
<div class="col-2">
<div class="box pr-2 pb-2 text-center">
<div class="sno s{{$i}}" data-id="{{$i}}">{{$i}}</div>
</div>
</div>
@endfor
</div>
<div class="mt-3">
	<span class="answered-spot"><i class="fa fa-circle "></i> </span>Answered &nbsp;<span class="unanswered"> <i class="fa fa-circle "></i> </span>Unanswered
	</div>
<button class="btn btn-outline-light mt-4" type="button" data-toggle="modal" data-target="#exampleModal">Submit Test</button>
</div>
</div>
</div>
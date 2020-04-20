
@if($f->label ) <div class="h5"><b>{{$f->label }}</b></div>  @endif 
<div class="row question ">

  <div class="col-12 col-md-1" id="{{$f->qno}}">
    <div class="card-text mb-3" ><span class="badge badge-warning h2">{{$f->qno}}</span>
    </div>
  </div>
  <div class="col-12 col-md-11">
    <div class="card-text">
    @include('appl.test.attempt.layouts.ielts_two_blank') 
    </div>
  </div>
</div>
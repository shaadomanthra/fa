
<div class="pt-3 pb-5 text-center duo-heading"><b>Select the real English words in this list</b></div>

<div class="row question no-gutters">
  	@foreach(["a","b","c","d","e","f","g","h","i","j",'k',"l"] as $k=>$item)
	    @if(\Storage::disk('public')->exists('extracts/'.$f->id.'_'.$item.'.mp3') )
	    <div class="col-6 col-md-4 mb-4">
	<div class="" style="margin:0px auto;max-width:180px">
  	<div class="audioitem a_{{$f->qno}}_{{$item}}" style="display: inline" >
  		<span class="audioed" data-id="{{$f->qno}}_{{$item}}">
		<audio id="audio_{{$f->qno}}_{{$item}}" class="audio_{{$item}}" src="{{ asset('/storage/extracts/'.$f->id.'_'.$item.'.mp3') }}" preload="auto" ></audio> <i class="fa fa-volume-up"></i> w<span class="d-none d-md-inline">ord </span>{{($k+1)}} &nbsp;&nbsp;
		</span>
	</div>
	<div class="checkitem" style="display: inline" data-class="{{$f->qno}}_{{$item}}">
		<i class="fa fa-check"></i><input type="checkbox" class="{{$f->qno}}_{{$item}}" name="{{$f->qno}}[]" value="{{$item}}" style="display: none">
	</div>
</div>
  </div>
	    @endif
    @endforeach
  



</div>
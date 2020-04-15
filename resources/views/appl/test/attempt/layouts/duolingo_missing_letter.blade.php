<style>
  input{width:30px;text-align: center;border:1px solid #c9dbe4;margin: 0px;padding:0px;float: left;}
  .lightb{background: #e7f2f9;color:#52b6e8;}
</style>
<span class="card-text question" id="{{$f->qno}}">
  @if($f->label ) <div><b>{{$f->label }}</b></div>  @endif 

  	
       @if($f->prefix ) {{$f->prefix }}  @endif 
       @if($f->answer) <span style="display:inline-block;margin-right: 5px;border-radius:5px;margin-left: 5px;" class="{{$open=0}}">
       @foreach(str_split($f->answer) as $i=>$k)
        @if($k==']' && $open==1)
          <span class="d-none">{{$open=0}}</span> 
        @elseif($k=='[')
          <span class="d-none">{{$open=1}}</span> 
        @elseif($open==0)<input type="text" class="" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='' >@elseif($open==1)<input type="text" class="lightb" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='{{$k}}' disabled><input type="hidden" class="" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='{{$k}}' >@endif
       @endforeach
       @endif
     </span>
       @if($f->suffix ){{$f->suffix }}@endif
    
       
  
</span>
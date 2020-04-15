

<span class="card-text question " id="{{$f->qno}}">
  @if($f->label ) <div><b>{{$f->label }}</b></div>  @endif 

  	
       @if($f->prefix ) <div style="display:inline-block;margin-top: 5px;float-left">{{$f->prefix }} </div> @endif 
       @if($f->answer) <div style="display:inline-block; margin-right: 10px;border-radius:5px;margin-left: 5px;margin-top: 5px;float:left" class="{{$open=0}} {{$k=0}} q{{$f->qno}}">
       @foreach(str_split($f->answer) as $i=>$k)
        @if($k==']' && $open==1)
          <span class="d-none">{{$open=0}}</span> 
        @elseif($k=='[')
          <span class="d-none">{{$open=1}}</span> 
        @elseif($open==0)<input type="text" class="duo duo_{{$i}} input" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='' maxlength = "1">@elseif($open==1)<input type="text" class="lightb" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='{{$k}}' disabled><input type="hidden" class="" name="{{$f->qno}}[]" data-id="{{$f->qno}}" value='{{$k}}' >@endif
       @endforeach
       @endif
     </div>
       @if($f->suffix )<div style="display:inline-block;margin-top: 5px;float:left">{{$f->suffix }}</div>@endif
    
       
  
</span>
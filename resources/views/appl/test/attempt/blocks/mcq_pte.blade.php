@foreach($section->mcq_order as $k=>$m)




@if(isset($m->extract))
<div class="row">
<div class="col-12 col-md-6">
  <div class="option rounded p-4 border mb-4">
    <h4 class="mb-3"><i class="fa fa-check-square-o"></i> {{ $m->extract->name }} </h4>
    {!!$m->extract->text !!}</div>
    <span class="d-none sentence_holder" data-qno="{{$m->qno}}"></span>
    <input type="hidden" name="{{$m->qno}}" value=""/>
</div> 
<div class="col-12 col-md-6">   
@endif


<div class="mb-3">
  <div class="row">
        
      <div class="col-12">
          <div class="question">{!! $m->question !!}</div>
      </div>
  </div>



<table class="table table-bordered mt-2 @if(strlen($m->a)>30) w-100 @else w-50 @endif" >
  @if($m->a)
  <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
    </td>
  </tr>
  @endif

  @if($m->b)
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="B" data-group="1">
        <input class='input {{$m->qno}}_B {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
    </td>
  </tr>
  @endif

  @if($m->c)
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="C" data-group="1">
        <input class='input {{$m->qno}}_C {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
    </td>
  </tr>
  @endif

  @if($m->d)
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="D" data-group="1">
        <input class='input {{$m->qno}}_D {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
    </td>
  </tr>
  @endif

  @if($m->e)
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="E" data-group="1">
        <input class='input {{$m->qno}}_E {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
    </td>
  </tr>
  @endif

  @if($m->f)
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="F" data-group="1">
        <input class='input {{$m->qno}}_F {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
    </td>
  </tr>
  @endif

</table>

@if(isset($m->extract))
</div>
</div> 
@endif
  
</div>  
    
@endforeach
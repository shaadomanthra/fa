<table class="table table-bordered mt-4 @if(strlen($m->a)>30) w-100 @else w-50 @endif" >
  
      @if($m->a || $m->a===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      </tr>
      @endif

      @if($m->b || $m->b===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="B" data-group="2">
        <input class='input {{$m->qno}}_B {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
      </td>
      </tr>
      @endif

      @if($m->c || $m->c===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_3 option" data-id="{{$m->qno}}" data-option="C" data-group="3">
        <input class='input {{$m->qno}}_C {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
      </td>
      </tr>
      @endif

      @if($m->d || $m->d===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_4 option" data-id="{{$m->qno}}" data-option="D" data-group="4">
        <input class='input {{$m->qno}}_D {{$m->qno}}_4' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
      </td>
      </tr>
      @endif

      @if($m->e || $m->e===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_5 option" data-id="{{$m->qno}}" data-option="E" data-group="5">
        <input class='input {{$m->qno}}_E {{$m->qno}}_5' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
      </td>
      </tr>
      @endif

      @if($m->f || $m->f===0)
      <tr>
      <td class="td_option td_{{$m->qno}}_6 option" data-id="{{$m->qno}}" data-option="F" data-group="6">
        <input class='input {{$m->qno}}_F {{$m->qno}}_4' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
      </td>
      </tr>
      @endif

      @if($m->g || $m->g==='0')
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="F" data-group="1">
        <input class='input {{$m->qno}}_G {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="G"/> {!! $m->g !!}
    </td>
  </tr>
  @endif

  @if($m->h || $m->h==='0')
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="F" data-group="1">
        <input class='input {{$m->qno}}_H {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="H"/> {!! $m->h !!}
    </td>
  </tr>
  @endif

  @if($m->i || $m->i==='0')
   <tr>
    <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="F" data-group="1">
        <input class='input {{$m->qno}}_I {{$m->qno}}_1' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="I"/> {!! $m->i !!}
    </td>
  </tr>
  @endif
 
</table>
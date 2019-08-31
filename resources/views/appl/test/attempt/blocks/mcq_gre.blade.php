@foreach($extract->mcq_order as $k=>$m)
@if($k!=0)<hr>@endif
<div class="mb-3">
  <div class="question">{!! $m->question !!}</div>
  

@if($m->layout == 'gre1')
<table class="table table-bordered w-25" >
  <tr>
      <td>
        <input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}</td><tr>
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}</td><tr>
      
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}</td></tr>

      @if($m->d)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->d !!}</td></tr>
      @endif

      @if($m->e)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->e !!}</td></tr>
      @endif

      @if($m->f)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}</td></tr>
      @endif

</table>
@endif

@if($m->layout == 'gre2')
<table class="table table-bordered w-50" >
  <tr>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->d !!}
      </td>
  <tr>
  <tr>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->b !!}
      </td>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->e !!}
      </td>
  <tr>
    <tr>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->c !!}
      </td>
      <td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->f !!}
      </td>
  <tr>
      

</table>
@endif


@if($m->layout == 'gre3')
<table class="table table-bordered w-75" >
  <tr>
      <td class="td_option td_{{$m->qno}}_1" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2" data-id="{{$m->qno}}" data-option="D" data-group="2">
        <input class='input {{$m->qno}}_D {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3" data-id="{{$m->qno}}" data-option="G" data-group="3">
        <input class='input {{$m->qno}}_G {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="G"/> {!! $m->g !!}
      </td>
  <tr>
  <tr>
      <td class="td_option td_{{$m->qno}}_1" data-id="{{$m->qno}}" data-option="B" data-group="1" ><input class='input {{$m->qno}}_B {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2" data-id="{{$m->qno}}" data-option="E" data-group="2"><input class='input {{$m->qno}}_E {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3" data-id="{{$m->qno}}" data-option="H" data-group="3"><input class='input {{$m->qno}}_H {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="H"/> {!! $m->h !!}
      </td>
  <tr>
    <tr>
      <td class="td_option td_{{$m->qno}}_1" data-id="{{$m->qno}}" data-option="C" data-group="1">
        <input class='input {{$m->qno}}_C {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2" data-id="{{$m->qno}}" data-option="F" data-group="2">
        <input class='input {{$m->qno}}_F {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3" data-id="{{$m->qno}}" data-option="I" data-group="3">
        <input class='input {{$m->qno}}_I {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="I"/> {!! $m->i !!}
      </td>
  <tr>
      

</table>
@endif

@if($m->layout == 'gre_maq')
<table class="table table-bordered w-25" >
  <tr>
      <td>
        <input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}</td><tr>
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}</td><tr>
      
      <tr><td ><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}</td></tr>

      @if($m->d)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->d !!}</td></tr>
      @endif

      @if($m->e)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->e !!}</td></tr>
      @endif

      @if($m->f)
      <tr><td><input class='input' type="radio" name="{{$m->qno}}"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}</td></tr>
      @endif
</table>
@endif
</div>            
@endforeach
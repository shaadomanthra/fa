<table class="table table-bordered w-75" >
   <tr>
      <td class="bg-secondary text-white border-secondary option">Blank 1
      </td>
      <td class="bg-secondary text-white border-secondary option">Blank 2
      </td>
  <tr>
  <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="D" data-group="2">
        <input class='input {{$m->qno}}_D {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
      </td>
  <tr>
  <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="B" data-group="1" ><input class='input {{$m->qno}}_B {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="E" data-group="2"><input class='input {{$m->qno}}_E {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
      </td>
  <tr>
    <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="C" data-group="1">
        <input class='input {{$m->qno}}_C {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="F" data-group="2">
        <input class='input {{$m->qno}}_F {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
      </td>
  <tr>
</table>
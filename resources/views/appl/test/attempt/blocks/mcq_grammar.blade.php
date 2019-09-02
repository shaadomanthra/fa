@foreach($test->mcq_order as $k=>$m)
@if($k!=0)<div class="mb-1 p-1"></div>@endif

@if(isset($m->extract))
  <div class="option rounded p-4 border mb-4">
    <h4 class="mb-3"><i class="fa fa-check-square-o"></i> {{ $m->extract->name }} </h4>
    {!!$m->extract->text !!}</div>
    <span class="d-none sentence_holder" data-qno="{{$m->qno}}"></span>
    <input type="hidden" name="{{$m->qno}}" value=""/>
@endif

@if(!$m->layout)
<div class="border p-3 rounded mb-4 text-secondary">Select one answer choice from the given options. </div>
@elseif($m->layout == 'gre1')
  <div class="border p-3 rounded mb-4 text-secondary">Select one answer choice for the blank. Fill in the blank in such a way that it best completes the text. </div>
@elseif($m->layout == 'gre2' || $m->layout == 'gre3')  
<div class="border p-3 rounded mb-4 text-secondary">
 For each blank, select an answer choice from the corresponding column of choices. Fill all blanks in such a way that they best complete the text. 
</div>
@elseif($m->layout == 'gre_maq')  
<div class="border p-3 rounded mb-4 text-secondary">
For the following question, select the one or more answer choices that, when inserted into the sentence, fit the meaning of the sentence as a whole and yield complete sentences that are similar in meaning. 
</div>
@elseif($m->layout == 'no_instruction') 
@endif

<div class="mb-3">
  <div class="row">
        <div class="col-4 col-md-3 col-lg-2">
          <div id="{{$m->qno}}" class="qno">{{$m->qno}}</div>
      </div>
      <div class="col-12 col-md-9 col-lg-10">
          <div class="question">{!! $m->question !!}</div>
      </div>
  </div>

@if(!$m->layout || $m->layout=='no_instruction')

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
@endif

@if($m->layout == 'gre1')

<table class="table table-bordered @if(strlen($m->a)>30) w-100 @else w-50 @endif" >
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
@endif

@if($m->layout == 'gre2')
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
@endif


@if($m->layout == 'gre3')
<table class="table table-bordered w-100" >

  <tr>
      <td class="bg-secondary text-white border-secondary option">Blank 1
      </td>
      <td class="bg-secondary text-white border-secondary option">Blank 2
      </td>
      <td class="bg-secondary text-white border-secondary option">Blank 3
      </td>
  <tr>
  <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="D" data-group="2">
        <input class='input {{$m->qno}}_D {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3 option" data-id="{{$m->qno}}" data-option="G" data-group="3">
        <input class='input {{$m->qno}}_G {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="G"/> {!! $m->g !!}
      </td>
  <tr>
  <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="B" data-group="1" ><input class='input {{$m->qno}}_B {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="E" data-group="2"><input class='input {{$m->qno}}_E {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3 option" data-id="{{$m->qno}}" data-option="H" data-group="3"><input class='input {{$m->qno}}_H {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="H"/> {!! $m->h !!}
      </td>
  <tr>
    <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="C" data-group="1">
        <input class='input {{$m->qno}}_C {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
      </td>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="F" data-group="2">
        <input class='input {{$m->qno}}_F {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
      </td>
      <td class="td_option td_{{$m->qno}}_3 option" data-id="{{$m->qno}}" data-option="I" data-group="3">
        <input class='input {{$m->qno}}_I {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="I"/> {!! $m->i !!}
      </td>
  <tr>
      

</table>
@endif

@if($m->layout == 'gre_maq')
<table class="table table-bordered mt-4 @if(strlen($m->a)>30) w-100 @else w-50 @endif" >
  
      @if($m->a)
      <tr>
      <td class="td_option td_{{$m->qno}}_1 option" data-id="{{$m->qno}}" data-option="A" data-group="1">
        <input class='input {{$m->qno}}_A {{$m->qno}}_1' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="A"/> {!! $m->a !!}
      </td>
      </tr>
      @endif

      @if($m->b)
      <tr>
      <td class="td_option td_{{$m->qno}}_2 option" data-id="{{$m->qno}}" data-option="B" data-group="2">
        <input class='input {{$m->qno}}_B {{$m->qno}}_2' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="B"/> {!! $m->b !!}
      </td>
      </tr>
      @endif

      @if($m->c)
      <tr>
      <td class="td_option td_{{$m->qno}}_3 option" data-id="{{$m->qno}}" data-option="C" data-group="3">
        <input class='input {{$m->qno}}_C {{$m->qno}}_3' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="C"/> {!! $m->c !!}
      </td>
      </tr>
      @endif

      @if($m->d)
      <tr>
      <td class="td_option td_{{$m->qno}}_4 option" data-id="{{$m->qno}}" data-option="D" data-group="4">
        <input class='input {{$m->qno}}_D {{$m->qno}}_4' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="D"/> {!! $m->d !!}
      </td>
      </tr>
      @endif

      @if($m->e)
      <tr>
      <td class="td_option td_{{$m->qno}}_5 option" data-id="{{$m->qno}}" data-option="E" data-group="5">
        <input class='input {{$m->qno}}_E {{$m->qno}}_5' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="E"/> {!! $m->e !!}
      </td>
      </tr>
      @endif

      @if($m->f)
      <tr>
      <td class="td_option td_{{$m->qno}}_6 option" data-id="{{$m->qno}}" data-option="F" data-group="6">
        <input class='input {{$m->qno}}_F {{$m->qno}}_4' type="checkbox" name="{{$m->qno}}[]"  data-id="{{$m->qno}}" value="F"/> {!! $m->f !!}
      </td>
      </tr>
      @endif
 
</table>
@endif
</div>            
@endforeach
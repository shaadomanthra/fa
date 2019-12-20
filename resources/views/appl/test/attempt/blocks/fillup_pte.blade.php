

@if(isset($section->fillup_order[0]))
  @if($section->fillup_order[0]->layout=='cloze_test')
  <div class="alert alert-primary alert-important mb-4 ">
    Below is a text with blanks. Click on each blank, a list of choices will appear. Select the appropriate answer choice for each blank.
  </div>
  @endif

  @if(isset($section->fillup_order[0]->extract))
    @if($section->fillup_order[0]->extract->layout=='dropin')
    <div class="alert alert-primary alert-important mb-4 ">
    In the text below some words are missing. Drag words from the box below to the appropriate place in the text. To undo an answer choice, double click the answer box.
    </div>
    @endif
  @endif

@endif


@foreach($section->fillup_order as $k=>$f)

  



  @if($f->qno==-1)
    @include('appl.test.attempt.layouts.fillup_example') 
  @else
    @if($f->layout=='gre_sentence')
      @include('appl.test.attempt.layouts.gre_sentence') 
    @elseif($f->layout=='dropdown')
      @include('appl.test.attempt.layouts.dropdown') 
    @elseif($f->layout=='paragraph')
      @include('appl.test.attempt.layouts.ielts_paragraph') 
    @elseif($f->layout=='cloze_test')
      @include('appl.test.attempt.layouts.cloze_test') 
    @elseif($f->layout=='ielts_two_blank')
      @include('appl.test.attempt.layouts.ielts_two_blank') 
    @elseif($f->layout=='two_blank')
      @include('appl.test.attempt.layouts.two_blank') 
     @elseif($f->layout=='dropin')
      @include('appl.test.attempt.layouts.dropin')  
    @elseif($f->layout=='pte_reorder')
      @include('appl.test.attempt.layouts.reorder')  
    @else
      @include('appl.test.attempt.layouts.gre_blank') 
    @endif   
  @endif
 
@endforeach

@if(isset($f->extract))
  <div class="option rounded bg-light p-4 border  mt-4 mb-4">
  @if($f->extract->layout=='dropin')


    @foreach(explode(',',strip_tags($f->extract->text)) as $k=> $word)
      <span  class="draggable border p-2 mr-3 rounded bg-white">{{$word}}</span>
    @endforeach

  @else
    <h4 class="mb-3"><i class="fa fa-check-square-o"></i> {{ $f->extract->name }} </h4>
    {!!$f->extract->text !!}
    <span class="d-none sentence_holder" data-qno="{{$f->qno}}"></span>
  <input type="hidden" name="{{$f->qno}}" value=""/>
  @endif
  
  </div>
  
  @endif









@foreach($test->fillup_order as $f)

    @if(isset($f->extract))
  <div class="option rounded p-4 border mb-4">
    <h4 class="mb-3"><i class="fa fa-check-square-o"></i> {{ $f->extract->name }} </h4>
    {!!$f->extract->text !!}</div>
    <span class="d-none sentence_holder" data-qno="{{$f->qno}}"></span>
    <input type="hidden" name="{{$f->qno}}" value=""/>
@endif

      @if($f->layout=='gre_sentence')
        @include('appl.test.attempt.layouts.gre_sentence') 
      @elseif($f->layout=='dropdown')
        @include('appl.test.attempt.layouts.dropdown') 
      @elseif($f->layout=='cloze_test')
        @include('appl.test.attempt.layouts.cloze_test') 
      @else
        @include('appl.test.attempt.layouts.gre_blank') 
      @endif   
    @endforeach
 


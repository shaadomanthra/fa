
<div class="alert alert-primary alert-important" role="alert">
  The text boxes in the left panel have been placed in a random order. Restore the original order by dragging the text boxes from the left panel to the right panel.
  
</div>
 <div class="row" data-value="@if(isset($pte)) {{ $pte =$pte +1 }} @else {{ $pte=1}} @endif">
    <div class="col-6">
      <div class="sortbox">
      <ul id = "sortable-{{$pte}}a" class="sortlist">
          @foreach(explode('/',$f->label) as $k => $item)
             <li class = "default sortitem" data-val="{{($k+1)}}">{{$item}}</li>
          @endforeach
      </ul>
      </div>
    </div>
    <div class="col-6">
      <div class="sortbox">
      <ul id = "sortable-{{($pte)}}b" class="sortlist">
          </ul>
          </div>
    </div>
    <input type="hidden" class="reorder-{{$pte}}b w-100 form-control" data-id="{{$f->qno}}" name="{{$f->qno}}" value="0"  >
  </div>
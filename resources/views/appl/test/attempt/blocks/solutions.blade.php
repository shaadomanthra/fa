
<div class="table-responsive">
<table class="table table-bordered mb-0">
  <thead>
    <tr>
      <th scope="col" style="width:10%">Qno</th>
      <th scope="col" style="width:30%">Question</th>
      <th scope="col" style="width:20%">Your Response</th>
      <th scope="col" style="width:20%">Result</th>
    </tr>
  </thead>
  <tbody>
    @foreach($result as $qno => $item)
    @if(isset($item->qno))
    <tr>
      <th scope="row">{{ $item->qno}}</th>
      <td>
        @if($item->fillup)
          @if($item->fillup->label)<b class=''>{{$item->fillup->label}}</b> @endif
          <div>
          @if($item->fillup->prefix)<span>{{$item->fillup->prefix}}</span> @endif
          @if($item->fillup->answer)<span class="text-success "><u>{{$item->fillup->answer}}</u></span> @endif
          @if($item->fillup->suffix)<span>{{$item->fillup->suffix}}</span> @endif
          </div>
        @else
          @if($item->mcq->question)<b class='h6' style="line-height: 1.5">{!! $item->mcq->question !!}</b> @endif
          <div>
          @if($item->mcq->a)<div class="@if(strpos($item->mcq->answer, 'A') !== FALSE) text-success @endif">(A){{$item->mcq->a}}</div> @endif
          @if($item->mcq->b)<div class="@if(strpos($item->mcq->answer, 'B') !== FALSE) text-success @endif">(B){{$item->mcq->b}}</div> @endif
          @if($item->mcq->c)<div class="@if(strpos($item->mcq->answer, 'C') !== FALSE) text-success @endif">(C){{$item->mcq->c}}</div> @endif
          @if($item->mcq->d)<div class="@if(strpos($item->mcq->answer, 'D') !== FALSE) text-success @endif">(D){{$item->mcq->d}}</div> @endif
          @if($item->mcq->e)<div class="@if(strpos($item->mcq->answer, 'E') !== FALSE) text-success @endif">(E){{$item->mcq->e}}</div> @endif
          @if($item->mcq->f)<div class="@if(strpos($item->mcq->answer, 'F') !== FALSE) text-success @endif">(F){{$item->mcq->f}}</div> @endif
          @if($item->mcq->g)<div class="@if(strpos($item->mcq->answer, 'G') !== FALSE) text-success @endif">(G){{$item->mcq->g}}</div> @endif
          @if($item->mcq->h)<div class="@if(strpos($item->mcq->answer, 'H') !== FALSE) text-success @endif">(H){{$item->mcq->h}}</div> @endif
          @if($item->mcq->i)<div class="@if(strpos($item->mcq->answer, 'I') !== FALSE) text-success  @endif">(I){{$item->mcq->i}}</div> @endif
          </div>


        @endif
      </td>
      <td>{{ $item->response}}</td>
      <td>@if($item->accuracy==1) 
        <span class="text-success"><i class="fa fa-check-circle"></i></span>
      @elseif($item->accuracy==2) 
       <span class="text-danger"><i class="fa fa-times-circle"></i></span> 
      @else 
        <span class="text-danger"><i class="fa fa-times-circle"></i></span>
      @endif</td>
    </tr>
    @elseif(isset($item['qno']))
    <tr>
      <th scope="row">{{ $item['qno']}}</th>
      <td>{{ $item['answer']}}</td>
      <td>@if($item['accuracy']==1 || $item['accuracy']>1 ) 
        <span class="text-success"><i class="fa fa-check-circle"></i></span>
      @else 
        <span class="text-danger"><i class="fa fa-times-circle"></i></span>
      @endif</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
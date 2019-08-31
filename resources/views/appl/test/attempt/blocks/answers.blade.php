<div class="table-responsive">
<table class="table table-bordered mb-0">
  <thead>
    <tr>
      <th scope="col" style="width:10%">Qno</th>
      <th scope="col" style="width:35%">Answer</th>
      <th scope="col" style="width:20%">Result</th>
    </tr>
  </thead>
  <tbody>
    @foreach($result as $qno => $item)
    @if($item->qno)
    <tr>
      <th scope="row">{{ $item->qno}}</th>
      <td>{{ $item->answer}}</td>
      <td>@if($item->accuracy==1) 
        <span class="text-success"><i class="fa fa-check-circle"></i></span>
      @elseif($item->accuracy==2) 
       <span class="text-danger"><i class="fa fa-times-circle"></i></span> 
      @else 
        <span class="text-danger"><i class="fa fa-times-circle"></i></span>
      @endif</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
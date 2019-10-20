
@foreach($section_score as $section=>$s)
<div class="border rounded p-4 mb-3 bg-light">
<h3 class="m-0"><i class="fa fa-check-square-o"></i> {{ $section }} <span class="float-right">{{$s['score'] }} / {{ count($s['questions']) }}</span></h3>
</div>
<div class="table-responsive mb-4">
<table class="table table-bordered mb-0">
  <thead>
    <tr>
      <th scope="col" style="width:10%">Qno</th>
      <th scope="col" style="width:35%">Answer</th>
      <th scope="col" style="width:20%">Result</th>
    </tr>
  </thead>
  <tbody>
    @foreach($s['questions'] as $qno => $item)
    
    <tr>
      <th scope="row">{{ $qno}}</th>
      <td>{{ $item->answer}}</td>
      <td>@if($item->accuracy==1) 
        <span class="text-success"><i class="fa fa-check-circle"></i></span>
      @elseif($item->accuracy==2) 
       <span class="text-danger"><i class="fa fa-times-circle"></i></span> 
      @else 
        <span class="text-danger"><i class="fa fa-times-circle"></i></span>
      @endif</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endforeach
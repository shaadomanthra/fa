<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="width:10%">Qno</th>
      <th scope="col" style="width:35%">Answer</th>
      <th scope="col" style="width:35%" >Your Response</th>
      <th scope="col" style="width:20%">Result</th>
    </tr>
  </thead>
  <tbody>
    @foreach($result as $qno => $item)
    @if($qno)
    <tr>
      <th scope="row">{{ $qno}}</th>
      <td>{{ $item['answer']}}</td>
      <td>{{ $item['response']}}</td>
      <td>@if($item['accuracy']==1) 
        <span class="badge badge-success">Correct</span>
      @elseif($item['accuracy']==2) 
       <span class="badge badge-secondary">Unattempted</span> 
      @else 
        <span class="badge badge-danger">Incorrect</span>
      @endif</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
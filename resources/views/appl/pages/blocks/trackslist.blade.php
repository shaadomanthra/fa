

@if(count(\auth::user()->tracks))
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr class="bg-light">
      <th scope="col">#</th>
      <th scope="col">Track Name</th>
      <th scope="col">Sessions</th>
    </tr>
  </thead>
  <tbody>
  	@foreach(\auth::user()->tracks as $k=>$track)
	<tr>
      <th scope="row">{{$k+1}}</th>
      <td>{{ $track->name }}</td>
      <td>
        @foreach($track->sessions as $s)
        @if($s->users->contains(\auth::user()->id))
        <div class="mb-2">{{$s->name }}  
          
            <span class='badge badge-warning'>Attended</span>
          
        
        <div class="text-secondary"><small>{{$s->created_at->format('d-m-Y') }}</small></div>
        </div>
        @endif
        @endforeach
      </td>
    </tr>		
	@endforeach
  </tbody>
</table>
</div>
@else
<div class="card">
	<div class="card-body">
		- No tracks -
	</div>
</div>
@endif

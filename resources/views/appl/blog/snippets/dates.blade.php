<div class="list-group mb-4">
@foreach($dates as $date)
  <a href="{{ route('year.list', [$date->YEAR,$date->MON])}}" class="list-group-item list-group-item-action  list-group-item-success @if(request()->is($date->YEAR.'/'.$date->MON)) active @endif">
    <b>{{$date->MONTH}} {{$date->YEAR}} </b>
  </a>
 @endforeach
</div>
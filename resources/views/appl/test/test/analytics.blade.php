@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->name }} - Analytics</li>
  </ol>
</nav>

@include('flash::message')
  <div class="row">
    <div class="col-12 col-md-9">
      <div class="card bg-white mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-bar-chart "></i> {{ $obj->name }} 
            <a href="{{ route('test.analytics',$obj->id)}}?all=1" class="btn btn-success float-right">View All</a>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-6 col-md-3 mb-3">
          <div class="card" style="background: #b4e8ca">
            <div class="pl-3 pr-3 pt-3 h5 mb-0">
                Participants
             
            </div>

            <div class="card-body">
              <div class="h1">
                   {{ $users['participants'] }}
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card " style="background: #fff8b4">
            <div class="pl-3 pr-3 pt-3 h5 mb-0">
                Highest
             
            </div>
            <div class="card-body">
              <div class="h1">
                @if($users['highest'])
                  {{ $users['highest'] }}
                @else
                  -
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card" style="background: #fff8b4">
            <div class="pl-3 pr-3 pt-3 h5 mb-0">
                Average
             
            </div>
            <div class="card-body">
              <div class="h1">
                @if($users['avg'])
                  {{ $users['avg'] }}
                @else
                  -
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card " style="background: #fff8b4">
            <div class="pl-3 pr-3 pt-3 h5 mb-0">
                Lowest
             
            </div>
            <div class="card-body">
              <div class="h1">
                  {{ $users['lowest'] }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="">
      @if($users['participants']!=0)
        <div class="table-responsive ">

<table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      @if($obj->testtype->name!='WRITING' && $obj->testtype->name!='SPEAKING')
      <th scope="col">Score</th>
      @endif
    </tr>
  </thead>
  <tbody class="{{$i=1}}">
    @foreach($score as $k=>$s)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td><a href="{{ route('user.show',$users[$k]['user']['id'])}}">{{ $users[$k]['user']['name']}}</a></td>

      @if($obj->testtype->name!='WRITING' && $obj->testtype->name!='SPEAKING')
      <td>{{ $s}}</td>
      @endif
    </tr>
    @if($i==6 && !request()->get('all'))
      @break
    @endif
    @endforeach
    
  </tbody>
</table>
        </div>
        @endif
      </div> 
    </div>
    <div class="col-12 col-md-3">
      @include('appl.test.snippets.menu')
    </div>
</div> 
@endsection
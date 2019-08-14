@extends('layouts.app')
@include('meta.show')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->name }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">

    <div class="col-md-12">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-th "></i> {{ $obj->name }} 

          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
            </span>
            @endcan
          </p>
        </div>
      </div>

     
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-md-4"><b>Name</b></div>
            <div class="col-md-8">{{ $obj->name }}</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Email</b></div>
            <div class="col-md-8">{{ $obj->email }}</div>
          </div>
         
          <div class="row mb-2">
            <div class="col-md-4"><b>Phone</b></div>
            <div class="col-md-8">{{$obj->phone}}</div>
          </div>
          
          <div class="row mb-2">
            <div class="col-md-4"><b>Status</b></div>
            <div class="col-md-8">@if($obj->status==0)
                    <span class="badge badge-danger">Blocked</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif</div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4"><b>Created At</b></div>
            <div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
          </div>
        </div>
      </div>

      @if(count($obj->tests())>0)
       <div class="card ">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped mb-0 border">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Test</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->tests() as $k=>$test)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td><a href="{{ route('user.test',[$obj->id,$test->id])}}">{{$test->name}}</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endif

    </div>

     

  </div> 




@endsection
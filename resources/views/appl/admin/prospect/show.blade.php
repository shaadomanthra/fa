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
    <div class="col-12 ">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
            
          <p class="h2 mb-0"><i class="fa fa-th "></i> {{ $obj->name }} 

          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              @if(\auth::user()->admin==1 ||\auth::user()->admin==2)
              <a href="{{ route('followup.create') }}?name={{$obj->name}}&phone={{$obj->phone}}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-telegram"></i> Followup</a>
              @endif
               @if(\auth::user()->admin==1 ||\auth::user()->admin==2)
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              @endif
              @if(\auth::user()->admin==1)
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
              @endif
            </span>
            @endcan
          </p>
        </div>
      </div>

     <div class='alert alert-important alert-warning border border-warning p-4' >
      <h5>Assign Test</h5>
      <a href="{{ route('user.create')}}?name={{$obj->name}}&email={{$obj->email}}&phone={{$obj->phone}}">
        <button class='btn btn-outline-secondary btn-sm'>Create User & Assign</button>
      </a>
     </div>
      <div class="card mb-4">
        <div class="card-body">

          <div class="row">
            <div class="col-12 col-md-3">
              <img src="{{ asset('images/boy.png')}}" class="w-75 mt-4">
            </div>

          <div class="col-12 col-md-9">    

            
            <div class="row mb-2">
              <div class="col-md-4"><b>Name</b></div>
              <div class="col-md-8">{{ $obj->name }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-md-4"><b>Email</b></div>
              <div class="col-md-8">{{ $obj->email }}
              </div>
            </div>
           
            <div class="row mb-2">
              <div class="col-md-4"><b>Phone</b></div>
              <div class="col-md-8">{{$obj->phone}}
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4"><b>Course</b></div>
              <div class="col-md-8">@if($obj->course)
                {{$obj->course }}
                @else
                -
                @endif
              </div>
            </div>
            
           <div class="row mb-2">
              <div class="col-md-4"><b>Mode</b></div>
              <div class="col-md-8">{{$obj->mode }}</div>
            </div>
            
            <div class="row mb-2">
              <div class="col-md-4"><b>Module</b></div>
              <div class="col-md-8">{{$obj->module }}</div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4"><b>Batch</b></div>
              <div class="col-md-8">{{$obj->batch }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-md-4"><b>Stage</b></div>
              <div class="col-md-8">
                @if($obj->stage=='enquiry')
                  <span class="badge badge-warning">{{ $obj->stage }}</span>
                  @elseif($obj->stage=='demo')
                  <span class="badge badge-primary">{{ $obj->stage }}</span>
                  @else
                  <span class="badge badge-success">{{ $obj->stage }}</span>
                  @endif
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4"><b>Counsellor</b></div>
              <div class="col-md-8">@if($obj->user){{$obj->user->name }}@else - @endif</div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4"><b>Center</b></div>
              <div class="col-md-8">{{$obj->center }}</div>
            </div>
           

            <div class="row mb-2">
              <div class="col-md-4"><b>Created At</b></div>
              <div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
            </div>
             
          </div>
        </div>
        </div>
      </div>



      


    </div>

     

  </div> 


@foreach($obj->followups()->orderBy('id','desc')->get() as $f)
  <div class=" bg-light border p-3 mb-3">
    <div class="media">
  <img class="mr-3 " src="{{ asset('images/man.png')}}" alt="Counsellor"  width="80px">
  <div class="media-body">
    <h5 class="mt-0">{{ $f->user->name}} <small class="text-secondary"style="font-size:12px;">{{ $f->created_at->diffForHumans()}}</small></h5>
    <p class="mt-0 mb-2 bg-white rounded border p-3">
      {{ $f->comment }}
    </p>
    @if($f->schedule)
    <p><i class="fa fa-clock-o"></i> Call Scheduled for :  <b><span class="text-info">{{ $f->schedule }}</span></b></p>
    @endif
    
  </div>
</div>
  </div>
  @endforeach


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This following action is permanent and it cannot be reverted.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <form method="post" action="{{route($app->module.'.destroy',$obj->id)}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-danger">Delete Permanently</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
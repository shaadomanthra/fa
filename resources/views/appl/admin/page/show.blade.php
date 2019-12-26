@extends('layouts.app')
@section('title', $obj->title. ' | First Academy')
@section('description', $obj->description)
@section('content')

@if(\auth::user())
@if(\auth::user()->admin==1)
<div class="p-3 bg-primary rounded text-light mb-3">
  <b class="badge badge-warning">Admin Controls </b>
  <small>This blue bar is not visible to public</small>
  @auth
  @if(\auth::user()->admin==1)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',$obj->slug) }}" class="btn btn-outline-light" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
            </span>
            @endif
            @endauth
  <h3>{{$obj->title}}</h3>
  Status : 
  @if($obj->status==1)<span class="badge badge-success">Active</span>@else
  <span class="badge badge-secondary">Inactive</span>@endif

</div>
@endif
@endif

@include('flash::message')

<div class="">
      {!!$obj->content!!}
</div> 

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
        
        <form method="post" action="{{route($app->module.'.destroy',$obj->slug)}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<button type="submit" class="btn btn-danger">Delete Permanently</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
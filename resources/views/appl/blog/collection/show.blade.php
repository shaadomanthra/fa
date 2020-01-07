@extends('layouts.app')
@section('title', $obj->meta_title.' | First Academy')
@section('description', $obj->meta_description)
@section('content')

<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">Category</a></li>
    <li class="breadcrumb-item">{{ $obj->name }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">
    <div class="col-12 ">
      <div class=" mb-3">
        <div class="pl-2 text-dark">
            
          <p class="h1 mb-0"><b> {{ $obj->name }} </b> 

          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              
               @if(\auth::user()->admin==1 ||\auth::user()->admin==2)
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              @endif
              @if(\auth::user()->admin==1)
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
              @endif
            </span>
            @endcan
          </p>
          <div class="body mt-3">
              <span class="badge badge-primary">{{$obj->slug}}</span>
             </div> 
        </div>
      </div>


           @if(\Storage::disk('public')->exists($obj->image) && $obj->image )
                    <div class=" mb-3">
                    <?php 
                    list($width, $height) = getimagesize(asset('storage/'.$obj->image)); 
                    $arr = array('h' => $height, 'w' => $width );
                    ?>
                      <img src="{{ asset('storage/'.$obj->image)}}"  class=" @if($arr['w']>680)w-25 @endif"/>
                    </div>
                    @else
                    @endif

            @if($obj->blogs)
      <div class="card mb-4 border border-light">
         <div class="card-body">
        
        @foreach($obj->blogs as $blog)
          <a href=""><h3>{{$blog->title}}</h3></a>
          <p>{{$blog->intro}}</p>
        @endforeach   
        
        </div>  
      </div>
      @endif
            
    </div>
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
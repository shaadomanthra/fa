@extends('layouts.app')
@section('title', $obj->name.' | Test | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
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

    <div class="col-12 col-md-9">
      <div class="card bg-white mb-3">
        <div class="card-body text-secondary">
          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',$obj->id) }}?category={{$obj->category->name}}&type={{$obj->testtype->name}}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Test"></i></a>
              <a href="{{ route('test',$obj->slug) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="public" target="_blank" ><i class="fa fa-globe" data-toggle="tooltip" data-placement="top" title="Public Page"></i></a>
              <a href="{{ route($app->module.'.view',$obj->slug) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="view" target="_blank" ><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Admin View"></i></a>
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"><span data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" ></i></span></a>
            </span>
            @endcan
          <p class="h2 mb-2"><i class="fa fa-th "></i> {{ $obj->name }} </p>
          <div class="mb-0">
            <span><b>Slug:</b> <a href="{{ route('test',$obj->slug) }}">{{ $obj->slug }}</a></span> | 

            <span><b>Category:</b><span class="text-primary"> <a href="{{ route('category.show',$obj->category->id) }}">
              {{ $obj->category->name }}
            </a></span></span> | 

            <span><b>Type:</b><a href="{{ route('type.show',$obj->testtype->id) }}">
              {{ $obj->testtype->name }}
            </a></span> |
            <span><b>Status:</b>
              @if($obj->status==0)
                    <span class="badge badge-warning">Inactive</span>
                  @elseif($obj->status==1)
                    <span class="badge badge-success">Active</span>
                  @endif
            </span>

          </div>
          <div class="mb-0">
            @if($obj->level)
            <div class="">
              <B>Level : </B>
              <span class="text-success">
                @for($i=$obj->level;$i>0;$i--)
                <i class="fa fa-circle "></i>
                @endfor
              </span>
              <span class="text-secondary">
                @for($i=(5-$obj->level);$i>0;$i--)
                <i class="fa fa-circle-o "></i>
                @endfor
              </span>
              | <span><b>Created:</b><span class="text-info">
              {{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</span>
            </span>
            </div>
            @else
            <B>Level : -</B>
            @endif
          </div>
            
          
          
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body">
          <h3>Test Details</h3>
          <p class="text-secondary">This information is visible on individual test page</p>
          @if($obj->details)
          {!! $obj->details !!}
          @else
          - 
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-6 col-md-3 mb-3">
          <div class="card">
            <div class="card-header h5">
                Marks
            </div>
            <div class="card-body">
              <div class="h1">
                @if($obj->marks)
                {{ $obj->marks }}
                @else
                -
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card">
            <div class="card-header h5">
                Test Time
            </div>
            <div class="card-body">
              <div class="h1">
              @if($obj->test_time)
              {{ $obj->test_time }} min
              @else
              -
              @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card">
            <div class="card-header h5">
                Price
            </div>
            <div class="card-body">
              <div class="h1">
              @if($obj->price===0)
                <span class="badge badge-warning">FREE</span>
              @elseif($obj->price)
                <i class="fa fa-rupee"></i> {{ $obj->price }} 
              @else
               -
              @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card">
            <div class="card-header h5">
                Validity
            </div>
            <div class="card-body">
              <div class="h1">
                @if($obj->validity)
                {{ $obj->validity }} m
                @else
                -
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
     
     @if(strtolower($obj->testtype->name)=='listening' || !$obj->testtype)
      <div class="card bg-light mb-4">
        <div class="card-body">
          <h3 class="mb-3">Audio File</h3>
          @if(\Storage::disk('public')->exists($obj->file) && $obj->file )
              <div class="bg-light border mb-3">
                 <audio>
                  <source src="{{ asset(\storage::disk('public')->url($obj->file))}}" type="audio/mp3">
                  </audio>
              </div>
              <form method="post" action="{{route($app->module.'.update',[$obj->id])}}" >
                 <input type="hidden" name="_method" value="PUT">
                 <input type="hidden" name="deletefile" value="1">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete File</button>
              </form>
              @else
               <span class="text-muted"><i class="fa fa-exclamation-triangle"></i> audio file path not found </span>
              @endif
        </div>
      </div>
      @endif

      <div class="card mb-4">
        <div class="card-body">
          <h3>Instructions (Optional)</h3>
          <p class="text-secondary">Empty instructions will skip the instruction screen</p>
          @if($obj->instructions)
          {!! $obj->instructions !!}
          @else
          - 
          @endif
        </div>
      </div>

     @if(strtolower($obj->testtype->name)=='writing' || !$obj->testtype)
      <div class="card mb-4">
        <div class="card-body">
          <h3>Writing Question</h3>
          
          @if($obj->description)
          {!! $obj->description !!}
          @else
          - 
          @endif
        </div>
      </div>
      @endif


      

      <div class="bg-light p-4 rounded mb-4 border">
        <h2>Test Cache</h2>
        
        @if(file_exists('../storage/app/cache/test/test.'.$obj->slug.'.json'))
        <p> Awesome ! your test is cached.<br>
        <small>Updated:  {{\Carbon\Carbon::parse($obj->cache_updated_at)->diffForHumans() }}</small></p>
        <a href="{{ route('test.cache',$obj->id)}}">
          <button class="btn btn-outline-success">Update Cache</button>
        </a>
        <a href="{{ route('test.cache.delete',$obj->id)}}">
          <button class="btn btn-outline-danger">Delete Cache</button>
        </a>
        @else
        <p>Cache can speedup performance by 20% so create one now.</p>
        <a href="{{ route('test.cache',$obj->id)}}">
          <button class="btn btn-outline-primary">Create Cache</button>
        </a>
        @endif
        
      </div> 


    </div>

    <div class="col-12 col-md-3">
      @include('appl.test.snippets.menu')
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
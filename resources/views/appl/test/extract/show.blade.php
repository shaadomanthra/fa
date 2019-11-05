@extends('layouts.app')
@include('meta.show')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/test')}}">Test</a></li>
    <li class="breadcrumb-item"><a href="{{ route('test.show',$app->test->id)}}">{{$app->test->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index',[$app->test->id]) }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->name }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">

    <div class="col-12 col-md-9">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-th "></i> 

            {{ $obj->name }} 
         

          @can('update',$obj)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',[$app->test->id,$obj->id]) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
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
            <div class="col-md-4"><b>Section</b></div>
            <div class="col-md-8">
              @if($obj->section)
              <a href="{{ route('section.show',[$app->test->id,$obj->section->id]) }}">
                {{ $obj->section->name }}
              </a>
              @else
              - NA -
              @endif
            </div>
          </div>
         
           <div class="row mb-2">
            <div class="col-md-4"><b>Seek Time</b></div>
            <div class="col-md-8">
              @if($obj->seek_time)
                {{ $obj->seek_time}} sec
               @else
                - NA -
               @endif 
           
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4"><b>Layout</b></div>
            <div class="col-md-8">
              @if($obj->layout)
                {{ $obj->layout}} 
               @else
                - NA -
               @endif 
           
            </div>
          </div>

           <div class="row mb-2">
            <div class="col-md-4"><b>Text</b></div>
            <div class="col-md-8">{!! $obj->text !!}</div>
          </div>

          
          <div class="row mb-2">
            <div class="col-md-4"><b>Created At</b></div>
            <div class="col-md-8">{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</div>
          </div>
        </div>
      </div>

      @if(count($obj->mcq)>0 || count($obj->fillup)>0)
      <div class="">
        <div class="card">
          <h5 class="card-header">Questions</h5>
          <div class="card-body">
             @foreach($obj->fillup as $f)
            <div class="row mb-2">
                <div class="col-12 col-md-4">
                  <div class="card-text float-right" style="text-align:right;"><b>{{ $f->label}}</b></div>
                </div>
                <div class="col-12 col-md-8">
                  <div class="card-text"><ul class="p-0 m-0"><li>
                  @if($f->prefix ) {{$f->prefix }}  @endif 
                  @if($f->answer)<u><i>({{$f->qno}}) {{$f->answer }}</i> </u> @endif
                  @if($f->suffix ){{$f->suffix }}@endif <a href="{{ route('fillup.edit',[$app->test->id,$f->id])}}"><i class="fa fa-pencil-square text-secondary"></i></a>
                </li></ul>
                  </div>
                </div>
            </div>
            @endforeach

            @foreach($obj->mcq as $k=>$m)
            @if($k!=0)<hr>@endif
            <div class="mb-3">
                <div class="row">
                    <div class="col-3 col-md-3 col-lg-2">
                      <div class="qno">{{$m->qno}}</div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10">
                      <div class="question">{!! $m->question !!} <a href="{{ route('mcq.edit',[$app->test->id,$m->id])}}"><i class="fa fa-pencil-square text-secondary"></i></a></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 col-md-3 col-lg-2">
                      <div class="op  @if($m->answer=='A') border-success @endif">A</div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10">
                      <div class="option">{!! $m->a !!}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 col-md-3 col-lg-2">
                      <div class="op @if($m->answer=='B') border-success @endif"">B</div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10">
                      <div class="option">{!! $m->b !!}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 col-md-3 col-lg-2">
                      <div class="op @if($m->answer=='C') border-success @endif"">C</div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10">
                      <div class="option">{!! $m->c !!}</div>
                    </div>
                </div>
                @if($m->d)
                <div class="row">
                    <div class="col-3 col-md-3 col-lg-2">
                      <div class="op @if($m->answer=='D') border-success @endif"">D</div>
                    </div>
                    <div class="col-12 col-md-9 col-lg-10">
                      <div class="option">{!! $m->d !!}</div>
                    </div>
                </div>
                @endif
            </div>
            
            @endforeach
          </div>
        </div>
      </div>
       @endif

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
        
        <form method="post" action="{{route($app->module.'.destroy',[$app->test->id,$obj->id])}}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<button type="submit" class="btn btn-danger">Delete Permanently</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
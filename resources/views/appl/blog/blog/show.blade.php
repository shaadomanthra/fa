@extends('layouts.app')
@section('title', $obj->meta_title.' | First Academy')
@section('description', $obj->meta_description)
@section('content')

<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->title }}</li>
  </ol>
</nav>

@include('flash::message')

  <div class="row">
    <div class="col-12 ">
      <div class=" mb-3">
        <div class="pl-2 text-dark">
            
          <p class="h1 mb-0"><b> {{ $obj->title }} </b> 

          @auth
          @if(\auth::user()->admin==1 ||\auth::user()->admin==2)
            <span class="btn-group float-right" role="group" aria-label="Basic example">
              
              @if(\auth::user()->admin==1 ||\auth::user()->admin==2)
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-secondary" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              @endif
              @if(\auth::user()->admin==1)
              <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
              @endif
            </span>
            @endif
          @endauth
           
          </p>
          <div class="mt-3"><i class="fa fa-calendar"></i> &nbsp;{{ \Carbon\Carbon::parse($obj->created_at)->format('M d Y') }} &nbsp;&nbsp;

            @if(count($obj->categories)!=0)|&nbsp;&nbsp; Category: 
            @foreach($obj->categories as $mc=>$cat)
            @if($mc!=0),@endif
            <a href="{{ route('category.list',$cat->slug)}}">{{$cat->name}}
            </a>
            @endforeach
            @endif
          </div>
        </div>
      </div>


     <div class="row">
        <div class="col-12 col-md-9">
            <div class="card mb-4 border border-light">
              <div class="card-body">

                 @if(\Storage::disk('public')->exists($obj->image) && $obj->image )
                    <div class=" mb-3">
                      <?php 
                      list($width, $height) = getimagesize(asset('storage/'.$obj->image)); 
                      $arr = array('h' => $height, 'w' => $width );
                      ?>
                      <img src="{{ asset('storage/'.$obj->image)}}"  class=" @if($arr['h']>680)w-100 @endif" style="max-width: 100%"/>
                    </div>
                  @endif
                
             <div class="body mt-3" style="font-size:17px;line-height: 25px">
              {!! $obj->body !!}
             </div>  


             @if($obj->test)
             @if($test->testtype='grammar' || $test->testtype='english')
             <div class="testbox body mt-3 ">
                @include('appl.blog.snippets.test')
             </div>  
             @endif
             @endif

             @if($obj->conlusion)
             <div class="body mt-3"  style="font-size:17px;line-height: 25px">
              {!! $obj->conlusion !!}
             </div>  
             @endif    
              
              <div class="body mt-3">
              @foreach($obj->tags as $tag)
              <a href="{{ route('tag.list',$tag->slug)}}">
              <span class="badge badge-primary">{{$tag->name}}</span>
            </a>
            @endforeach
             </div> 
              </div>  
            </div>

            @if(count($obj->related))
            <h3 class="mb-4">Related</h3>
            @include('appl.blog.snippets.related')
            @endif
        </div>
     

      <div class="col-12 col-md-3">    
        <div class="h3  pb-3">Read about</div>
        @include('appl.blog.snippets.categories')
        <div class="h3 pt-3 pb-3" >Other posts</div>
        @include('appl.blog.snippets.dates')

      </div>

       </div>
      


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
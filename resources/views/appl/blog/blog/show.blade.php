@extends('layouts.app')
@section('title', $obj->meta_title.' | First Academy')
@section('description', $obj->meta_description)
@section('content')

<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
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
          <div class="mt-3"><i class="fa fa-calendar"></i> &nbsp;{{ \Carbon\Carbon::parse($obj['created_at'])->format('M d Y') }} &nbsp;&nbsp;

            @if(count($obj->categories)!=0)|&nbsp;&nbsp; Category: 
            @foreach($obj->categories as $cat)
              <span class="badge badge-success">{{$cat->name}}</span>
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
                      <img src="{{ asset('storage/'.$obj->image)}}"  class=" @if($arr['h']>680)w-100 @endif"/>
                    </div>
                    @else
                    @endif
                
             <div class="body mt-3" style="font-size:17px;line-height: 25px">
              {!! $obj->body !!}
             </div>  


             @if($obj->test)
             <div class="body mt-3">
              {{$obj->test}}
             </div>  
             @endif

             @if($obj->conlusion)
             <div class="body mt-3"  style="font-size:17px;line-height: 25px">
              {!! $obj->conlusion !!}
             </div>  
             @endif    
              
              <div class="body mt-3">
              @foreach($obj->tags as $tag)
              <span class="badge badge-primary">{{$tag->name}}</span>
            @endforeach
             </div> 
              </div>  
            </div>

            <h3 class="mb-4">Related</h3>
            <div class="row">
              <div class="col-12 col-md-4">
                <h5><a href="">The Best Preparation For IELTS</a></h5>
                <p>One of the most important aspects of IELTS preparation is thoroughly understanding the pattern of the test. Knowing that there are 4 sections is easy. This is, by now, </p>
                <span class="text-info">Jan 12 2019</span><br>
                <span class="badge badge-success">General Interest</span>
              </div>
              <div class="col-12 col-md-4">
                <h5><a href="">Task Response – IELTS Writing Task 2</a></h5>
                <p>Select ideas that address the IELTS Writing Task 2 Topic*
Smoking is injurious to health. This information is written everywhere, even on the cigarette packets.</p>
                <span class="text-info">Dec 12 2019</span><br>
                <span class="badge badge-success">Writing</span>
              </div>
              <div class="col-12 col-md-4">
                <h5><a href="">10 IELTS Myths – Part 2</a></h5>
                <p>While practicing
sample questions is a good way to familiarise yourself with the structure and
fine tune your timing, it does not equate with a good score. </p>
                <span class="text-info">Feb 18 2019</span><br>
                <span class="badge badge-success">IELTS</span>
              </div>
            </div>
        </div>
     

      <div class="col-12 col-md-3">    
            <div class="h3  pb-3">Read about</div>
             <div class="list-group mb-4">
  <a href="#" class="list-group-item list-group-item-action  list-group-item-primary">
    General Interest
  </a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-primary">GRE</a>
  <a href="#" class="list-group-item list-group-item-action active list-group-item-primary">IELTS</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-primary">PTE</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-primary" tabindex="-1" aria-disabled="true">OET</a>
</div>

      <div class="h3 pt-3 pb-3" >Other posts</div>
             <div class="list-group mb-4">
  <a href="#" class="list-group-item list-group-item-action  list-group-item-success">
    October 2019
  </a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-success">August 2019</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-success">July 2019</a>
  <a href="#" class="list-group-item list-group-item-action active list-group-item-success">March 2019</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-success" tabindex="-1" aria-disabled="true">January 2019</a>
</div>

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
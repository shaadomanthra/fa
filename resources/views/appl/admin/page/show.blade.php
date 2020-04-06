@extends('layouts.pagelayout')
@section('title', $obj->title. ' | First Academy')
@section('description', $obj->description)
@section('content')

@include('flash::message')

<div class="">

  @if(isset($obj->intro))
    {!! $obj->intro!!}
    @if($obj->test)
             @if($test->testtype='grammar' || $test->testtype='english')
             <div class="testbox body mt-3 ">
                @include('appl.blog.snippets.test')
             </div>  
             @endif
             @endif
    {!! $obj->conclusion!!}
  @else
      {!!$obj->content!!}
  @endif
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
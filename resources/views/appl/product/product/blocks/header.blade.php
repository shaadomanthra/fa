<div class=" container ">
  <div class="pb-1">
    <a href="{{ url('/')}}" class="text-secondary">Home</a> 
    &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
    <a href="{{ url('/products')}}" class="text-primary">Products</a> 
  </div>
  <h1 class="h3 mb-0"><b> {{ $obj->name }} </b>
    @can('update',$obj)
    <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
    @endcan

    <span class="float-right " > {{ count($obj->tests)}}  @if(count($obj->tests)>1)Tests @else Test @endif </span> 
  </h1>
</div>
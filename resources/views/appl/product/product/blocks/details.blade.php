@if(strip_tags($obj->details))
  <div class="">
  <h4>Product Details @can('update',$obj)
                <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                @endcan</h4>
  <p>{!! $obj->details !!}</p>
  </div>
  @endif
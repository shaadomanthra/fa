@if(\auth::user())
@if(\auth::user()->admin==1)
<div class="p-3 bg-primary  text-light ">
  @auth
  @if(\auth::user()->admin==1)
            <span class="btn-group float-right btn-group-sm" role="group" aria-label="Basic example">
              <a href="{{ route($app->module.'.edit',$obj->id) }}" class="btn btn-outline-light" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
              <a href="{{ route($app->module.'.index') }}" class="btn btn-outline-light" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-bars"></i> All</a>
              <a href="#" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModal" data-tooltip="tooltip" data-placement="top" title="Delete" ><i class="fa fa-trash"></i></a>
            </span>
            @endif
            @endauth
  <h5 class='mt-1'>{{$obj->title}} &nbsp;
  @if($obj->status==1)<span class="badge badge-success">Active</span>@else
  <span class="badge badge-secondary">Inactive</span>@endif
  </h5>
</div>
@endif
@endif
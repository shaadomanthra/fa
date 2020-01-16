
<div class="p-3 bg-dark rounded border mb-3">
	<span class="badge badge-warning mb-3">Admin menu</span>
@if(!request()->is('admin/collection*') && !request()->is('admin/label*'))
@can('create',$obj)
<div class="row no-gutters">
	<div class="col-12 col-md">
		<div class="mr-md-1 mb-2">
		<a href="{{route($app->module.'.create')}}" class="btn btn-success w-100 mr-md-1">
              <i class="fa fa-book"></i> Create 
            </a>
        </div>
	</div>
	<div class="col-12 col-md">
		<div class="ml-md-1 mb-2">
		<a href="{{route($app->module.'.index')}}?refresh=1" class="btn btn-primary w-100">Refresh
            </a>
        </div>
	</div>
	</div>
            
            
            @endcan
@endif


<div class="list-group  ">
	<a href="{{ route('blog.index')}}" class="list-group-item   list-group-item-dark list-group-item-action  {{  request()->is('blog') ? 'active' : ''  }} ">
		<i class="fa fa-th"></i> Blogs
	</a>
	<a href="{{ route('collection.index')}}" class="list-group-item   list-group-item-dark list-group-item-action {{  (request()->is('admin/collection*')) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Categories </a>
	
	<a href="{{ route('label.index')}}" class="list-group-item  list-group-item-dark list-group-item-action {{  (request()->is('admin/label*') ) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Tags</a>
</div>


</div>




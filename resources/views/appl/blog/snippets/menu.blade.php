
<div class="p-3 bg-light border mb-3">
	<span class="badge badge-warning mb-3">Admin menu</span>
@if(!request()->is('admin/collection*') && !request()->is('admin/label*'))
@can('create',$obj)
            <a href="{{route($app->module.'.create')}}">
              <button type="button" class="btn btn-success w-100 mb-3"><i class="fa fa-book"></i> Create {{ ucfirst($app->module) }}</button>
            </a>
            @endcan
@endif


<div class="list-group ">
	<a href="{{ route('blog.index')}}" class="list-group-item list-group-item-action  {{  request()->is('admin/blog*') ? 'active' : 'bg-light'  }} ">
		<i class="fa fa-th"></i> Blogs
	</a>
	<a href="{{ route('collection.index')}}" class="list-group-item list-group-item-action {{  (request()->is('admin/collection*')) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Categories </a>
	<a href="{{ route('label.index')}}" class="list-group-item list-group-item-action {{  (request()->is('admin/label*') ) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Tags</a>
</div>


</div>

@if(!request()->is('admin/collection*') && !request()->is('admin/label*'))
<form class=" mb-4 mt-4 w-100" method="GET" action="{{ route($app->module.'.index') }}">
            <div class="input-group ">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
              </div>
              <input class="form-control " id="search" name="item" autocomplete="off" type="search" placeholder="Search" aria-label="Search" 
              value="{{Request::get('item')?Request::get('item'):'' }}">
            </div>
            
          </form>
@endif




<div class="list-group  mb-3">
	<a href="{{ route('blog.index')}}" class="list-group-item list-group-item-action  {{  request()->is('admin/blog*') ? 'active' : 'bg-light'  }} ">
		<i class="fa fa-th"></i> Blogs
	</a>
	<a href="{{ route('collection.index')}}" class="list-group-item list-group-item-action {{  (request()->is('admin/collection*')) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Categories </a>
	<a href="{{ route('label.index')}}" class="list-group-item list-group-item-action {{  (request()->is('admin/label*') ) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Tags</a>
</div>


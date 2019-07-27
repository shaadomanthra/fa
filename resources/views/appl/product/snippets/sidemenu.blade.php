
<div class=" bg-info mb-3 text-white rounded"><div class="p-3 font-weight-bold">Product Filters</div>
<div class="list-group mb-3">
	<a href="{{ route('product.public')}}" class="list-group-item list-group-item-action list-group-item-info {{ request()->is('campus/admin*') ? 'active' : '' }}">
		<i class="fa fa-bars"></i> FREE 
	</a>
	<a href="{{ route('product.public')}}" class="list-group-item list-group-item-action list-group-item-info {{ request()->is('campus/courses*') ? 'active' : '' }}">
		<i class="fa fa-navicon"></i> Premium
	</a>
</div>
</div>



<div class="list-group  mb-3">
	<a href="{{ route('prospect.index')}}" class="list-group-item list-group-item-action  {{  request()->is('admin/prospect*') ? 'active' : 'bg-light'  }} ">
		<i class="fa fa-th"></i> Prospects 
	</a>
	<a href="{{ route('followup.index')}}" class="list-group-item list-group-item-action {{  (request()->is('admin/followup*') && !request()->get('today') ) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Followup (All)</a>
	<a href="{{ route('followup.index')}}?today=1" class="list-group-item list-group-item-action {{  (request()->is('admin/followup') && request()->get('today') ) ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Followup (Today)</a>
</div>




<div class="list-group">
	<a href="{{ route('test.show',$app->test->id)}}" class="list-group-item list-group-item-action  {{  request()->is('admin/test/'.$app->test->id) ? 'active' : 'bg-light'  }} ">
		<i class="fa fa-inbox"></i> Test Home 
	</a>
	<a href="{{ route('section.index',$app->test->id)}}" class="list-group-item list-group-item-action {{  request()->is('admin/test/*/section*') ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Sections</a>
	<a href="{{ route('extract.index',$app->test->id)}}" class="list-group-item list-group-item-action {{  request()->is('admin/test/*/extract*') ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Extracts</a>
	<a href="{{ route('mcq.index',$app->test->id)}}" class="list-group-item list-group-item-action {{  request()->is('admin/test/*/mcq*') ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> MCQ</a>
	<a href="{{ route('fillup.index',$app->test->id)}}" class="list-group-item list-group-item-action {{  request()->is('admin/test/*/fillup*') ? 'active' : ''  }}">&nbsp;&nbsp;&nbsp;<i class="fa fa-bars"></i> Fillup</a>

	
</div>
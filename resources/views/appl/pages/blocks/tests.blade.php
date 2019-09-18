<div class="mt-4">
	<h3 class="mb-4 p-4 bg-light border">My Tests </h3>
	<div class="row">
		@foreach(auth::user()->orders()->where('status',1)->get() as $k=>$order)
		@if(strtotime($order->expiry) > strtotime(date('Y-m-d')))
		@if($test = $order->test)
			@include('appl.pages.blocks.test')
		@endif

		@if($product = $order->product)
			@foreach($product->tests as $test)
				@include('appl.pages.blocks.test')
			@endforeach
		@endif
		@endif
		@endforeach


	</div>
</div>
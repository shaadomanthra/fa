<div class="mt-4">
	<h3 class="mb-4 p-4 bg-light border">My Tests </h3>
	<div class="row">
		@foreach($tests as $test)
		<div class="col-12 col-md-6 col-lg-4"> 
				@include('appl.pages.blocks.test')
			</div>
		@endforeach
	</div>
</div>
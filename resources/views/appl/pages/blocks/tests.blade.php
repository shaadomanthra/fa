<div class="mt-4">
	<h3 class="mb-4 p-4 bg-light border">My Tests </h3>
	<div class="row">
		@foreach($tests as $test)
				@include('appl.pages.blocks.test')
		@endforeach
	</div>
</div>
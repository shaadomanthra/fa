
@auth
<a href="{{ route('product.checkout',$obj->slug) }}">
	<button class="btn btn-lg btn-success">Buy Now</button>
</a>
@else
	<button type="button" class="btn btn-lg btn-success" type="button" data-toggle="modal" data-target="#exampleModal">Buy Now</button>
@endauth


@auth
<a href="{{ route('product.checkout-access',$obj->slug) }}">
	<button class="btn btn-lg btn-outline-primary">Access Code</button>
</a>
@else
	<button type="button" class="btn btn-lg btn-outline-primary" type="button" data-toggle="modal" data-target="#exampleModal">Access Code</button>
@endauth

@include('blocks.loginmodal')

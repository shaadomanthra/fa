

@if(count($products))
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr class="bg-light">
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
      <th scope="col">Valid Till</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($products as $k=>$product)
	<tr>
      <th scope="row">{{$k+1}}</th>
      <td><a href="{{ route('product.view',$product->slug)}}">{{ strip_tags($product->name)}}</a></td>
      <td>{{ date('d M Y', strtotime($product_expiry[$product->id]))}}</td>
      <td>
      	{{ $product_status[$product->id]}}
      </td>
      <td>
			<a href="{{ route('product.view',$product->slug)}}">
				<button class="btn  btn-sm btn-success">view</button>
			</a>
		</td>
    </tr>		
	@endforeach
  </tbody>
</table>
</div>
@else
<div class="card">
	<div class="card-body">
		- No products -
	</div>
</div>
@endif

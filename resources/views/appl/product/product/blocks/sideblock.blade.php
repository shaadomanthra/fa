 <div class="card  mb-4" style="background: #fffcd8;border:1px solid #cecaa2;">
  <div class="card-body ">
      @if($obj->image)
      <div class="mb-4">
        <img src="{{ asset('storage/'.$obj->image) }}" class="@if(count($obj->tests)!=0)w-50 @endif d-none d-md-block" @if(count($obj->tests)==0) style="width:150px"@endif>
      </div>
      @endif
      <p>{!! $obj->description !!} </p>

      @if(count($obj->tests)==0)
      <p>{!! $obj->details !!} </p>
      @endif

      @auth
      @if(\auth::user()->isSuperAdmin())
      <a href="{{ route($app->module.'.edit',$obj->id) }}" class="h5" data-tooltip="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i> edit</a>
      <br><br>
      @endif
      @endauth

      @if(\auth::user())
       @if($obj->order)
        @if(strtotime($obj->order->expiry) > strtotime(date('Y-m-d')))
         <div class="border p-3 rounded ">
          <i class="fa fa-check-circle text-success"></i> Your service is activated <span class="text-secondary">{{ $obj->order->created_at->diffForHumans()}}</span>
        </div>
        @else
        <div class="border p-3 rounded mb-3">
        <i class="fa fa-times-circle text-danger"></i> Your service is Expired
        </div>
          @if($obj->price !=0)
          <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
          @include('appl.test.test.buy')
          @else
          <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
          <form method="post" action="{{ route('product.order')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="txn_amount" value="0">
            <input  type="hidden" name="product_id"  value="{{ $obj->id }}">
            <input  type="hidden" name="coupon"  value="FREE">
            <button class="btn btn-lg btn-success" type="submit">Access Now</button>
          </form>
          @endif
        @endif
       @else
        @if($obj->price !=0)
        <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
        @include('appl.test.test.buy')
        @else
        <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
        <form method="post" action="{{ route('product.order')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="txn_amount" value="0">
          <input  type="hidden" name="product_id"  value="{{ $obj->id }}">
          <input  type="hidden" name="coupon"  value="FREE">
          <button class="btn btn-lg btn-success" type="submit">Access Now</button>
        </form>
        @endif
       @endif
      @else
        @if($obj->price !=0)
        <p class="h3 mb-4"><i class="fa fa-rupee"></i> {{ $obj->price}}</p>
        @include('appl.test.test.buy')
        @else
        <p class="h3 mb-4"><span class="badge badge-warning">FREE</span></p>
        @endif
      @endif
  </div>
</div>
@if(count($obj->orders)>0)
       <div class="card ">
        <div class="card-body">
          <div class="card-title">
          <h3>Products/Tests</h3>
        </div>
          <div class="table-responsive">
            <table class="table table-bordered mb-0 border">
              <thead>
                <tr class="bg-light">
                  <th scope="col">#</th>
                  <th scope="col" >Product/Test</th>
                  <th scope="col" class="w-25">Order ID</th>
                  
                  <th scope="col" >Coupon</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->orders as $k=>$order)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td>
                        @if($order->test_id)
                        {{$order->test->name}}
                        @else
                        {{$order->product->name}}
                        @endif
                      </td>
                      <td><a href="{{ route('order.show',[$order->id])}}">{{$order->order_id}}</a></td>
                      
                      <td>{{(strlen($order->txn_id)<7 && $order->txn_id)? $order->txn_id : '-'}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @endif
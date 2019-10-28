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
                  
                  <th scope="col" >Coupon / Referral</th>
                </tr>
              </thead>
              <tbody>
                @foreach($obj->orders as $k=>$order)
                  <tr>
                      <td>{{$k+1}}</td>
                      <td>
                        @if($order->test_id)
                        <a href="{{ route('user.test',[$obj->id,$order->test->id])}}">
                        {{$order->test->name}}  
                        </a>
                        @if($obj->attempted($obj->id,$order->test->id))
                        <span class="badge badge-secondary">attempted</span>
                        @endif
                        @if($obj->testscore($obj->id,$order->test->id))
                              - Score : {{ $obj->testscore($obj->id,$order->test->id) }} 
                        @endif
                      
                        @else
                        {{$order->product->name}}
                        <ul>
                          @foreach($order->product->tests as $test)
                            <li><a href="{{ route('user.test',[$obj->id,$test->id])}}">{{ $test->name }}
                              
                            </a>

                            @if($obj->attempted($obj->id,$test->id))
                            <span class="badge badge-secondary">attempted</span>
                            @endif

                            @if($obj->testscore($obj->id,$test->id))
                              - Score : {{ $obj->testscore($obj->id,$test->id) }} 
                              @endif</li>
                          @endforeach
                        </ul>
                        @endif
                      </td>
                      <td><a href="{{ route('order.show',[$order->id])}}">{{$order->order_id}}</a></td>
                      
                      <td>{{$order->txn_id}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @endif
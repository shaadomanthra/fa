@extends('layouts.app')
@section('title', 'Admin | '.getenv('APP_NAME'))
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
<div class="container">
    <div class="row">
        @if(\auth::user()->admin!=4)
        <div class="col-12 col-md-4 col-lg-4">
            <div class="bg-primary text-light  rounded p-4 mb-4">
                <h3><i class="fa fa-user"></i> Users <Span class="float-right">{{$data['users']->count()}}</Span></h3>
                <hr>
                @foreach($data['users'] as $k=>$user)
                <div class="mb-2"><a href="{{ route('user.show',$user->id) }}" class="text-white">{{$user->name}}</a>
                    
                    @if($user->enrolled)
                    <span class="badge badge-info text-white">Enrolled </span>
                    @endif
                    <span class="float-right text-info">{{ $user->created_at->diffForHumans()}}</span></div>
                @if($k==2)
                    @break
                @endif
                @endforeach
                

                <a href="{{ route('user.index')}}"><button class="btn btn-outline-light btn-sm mt-3">view all</button></a>
            </div>

            <div class="bg-secondary text-light rounded p-4 mb-4">
                <h3 class="mb-0"><i class="fa fa-file-o"></i> Writing <span class="badge badge-warning">new</span> <Span class="float-right ">{{ $data['writing']->count() }}</Span></h3>
                @if($data['writing']->count())
                <hr>
                @foreach($data['writing'] as $k=>$w)
                <div class="mb-2"><a href="{{ route('file.show',$w->id) }}" class="text-white">{{$w->user->name}} </a><span class="float-right " style="color:#888f94">{{ $w->created_at->diffForHumans()}}</span></div>
                @if($k==2)
                    @break
                @endif
                @endforeach

                <a href="{{ route('file.index')}}?type=writing"><button class="btn btn-outline-light btn-sm mt-3">view list</button></a>   
                @endif  
            </div>

             <div class=" text-light rounded p-4 mb-4" style="background-color: #55a95f">
                <h3 class="mb-0"><i class="fa fa-envelope-o"></i> Forms  </h3>
                @if($data['form']->count())
                <hr>
                @foreach($data['form'] as $k=>$w)
                <div class="mb-2"><a href="{{ route('form.show',$w->id) }}" class="text-white">{{$w->name}} </a><span class="float-right " style="color:#a5e1ba">{{ $w->created_at->diffForHumans()}}</span>
                <p><small style='color:#a5e1ba'><i class="fa fa-commenting"></i> {{$w->subject}} 
                    @if($w->status)<span class="badge badge-primary">closed</span>@else <span class="badge badge-warning">open</span>
                    @endif </small></p>
                </div>
                @if($k==2)
                    @break
                @endif
                @endforeach

                <a href="{{ route('form.index')}}"><button class="btn btn-outline-light btn-sm mt-3">view list</button></a>   
                @endif  
            </div>



        

        </div>
        @endif
        <div class="col-12 col-md-8 col-lg-8">
                <div class="row no-gutters">
        @if(\auth::user()->admin==1)
        
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('test.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/test.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Tests</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('product.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/products.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Products</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('order.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/orders.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Orders</div>
                </div>
            </div>
            </a>
        </div>
        @endif

        @if(\auth::user()->admin!=4)
        
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('user.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/users.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Users</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('form.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/email.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Forms</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('prospect.dashboard') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/prospect.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Prospects</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('coupon.index') }}">
            <div class="border bg-white p-3 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/coupon.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Coupons</div>
                </div>
            </div>
            </a>
        </div>
        @endif

        @if(\auth::user()->admin==1)
        
       
         <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('admin.analytics') }}">
            <div class="border bg-white p-4 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/analytics.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Analytics</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('editor.index') }}">
            <div class="border bg-white p-4 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/settings.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Settings</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('page.index') }}">
            <div class="border bg-white p-4 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/page.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Pages</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('blog.index') }}">
            <div class="border bg-white p-4 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/blog.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Blog</div>
                </div>
            </div>
            </a>
        </div>
        @endif

        @if(\auth::user()->admin==4 ||\auth::user()->admin==1)

        <div class="col-4 col-md-3 col-lg-2">
            <a href="{{ route('file.index') }}?type=writing">
            <div class="border bg-white p-4 rounded mb-3 mr-2">
                <div>
                    <img src="{{ asset('images/admin/writing.png') }}" class="w-100 mb-3" >
                    <div class="text-center">Writing</div>
                </div>
            </div>
            </a>
        </div>

        
        @endif

    </div>

@if(\auth::user()->admin!=4)

<div class="row">
    <div class="col-12 ">
        <div class="">
    <h5 class="rounded mt-4 border p-2"><i class="fa fa-plus-square-o"></i> Latest Logins</h5>
    <div class="table-responsive mb-4">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="width:30%">User</th>
      <th scope="col">Attempted</th>
      <th scope="col">Last Login</th>
    </tr>
  </thead>
  <tbody class="{{$k=0}}">
    @foreach($data['new'] as $l)
    <tr class="{{ $k++}}">
      
      <td><a href="{{ route('user.show',$l->id) }}" class="">{{ $l['name']}}</a> </td>
      <td>{{ $l->testCount() }} </td>
      <td>{{ \Carbon\Carbon::parse($l->lastlogin_at)->diffForHumans()}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>
</div>
</div>
    </div>

</div>

<div class="bg-white p-4 rounded">
    <h3 class="mb-4"><i class="fa fa-gg"></i> Tests Attempted
    </h3>
    <div class="table-responsive">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Test</th>
      <th scope="col">User</th>
      <th scope="col">Attempted</th>
    </tr>
  </thead>
  <tbody class="{{$k=0}}">
    @foreach($data['latest'] as $l)
    <tr class="{{ $k++}}">
      <td><a href="{{ route('user.test',[$l['user']['id'],$l['test']['id']]) }}">{{ $l['test']['name']}}</a></td>
      <td><a href="{{ route('user.show',$l['user']['id']) }}" class="">{{ $l['user']['name']}}</a> @if($l['user']['idno']) <span class="badge badge-info text-white">Enrolled</span>@endif</td>
      <td>{{ $l['attempt']->created_at->diffForHumans()}}</td>
    </tr>
    @if($k==10)
        @break
    @endif
    @endforeach
   
  </tbody>
</table>
</div>
</div>
@endif
        </div>
    </div>

</div>
@endsection

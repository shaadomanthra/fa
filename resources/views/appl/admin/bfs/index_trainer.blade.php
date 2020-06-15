@extends('layouts.app')
@section('title', 'Admin | '.getenv('APP_NAME'))
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
<div class="container">
    <div class="row">
        @if(\auth::user()->admin==4)
        <div class="col-12 col-md-4 col-lg-4">

            <div class="card mb-4  ">
        <div class="bg-image" style="background-image: url({{asset('images/bg/bg5.jpg')}})"> 
        </div>
        <div class="user_container">
          @if(\Storage::disk('public')->exists('images/'.\auth::user()->id.'.jpg')) 
         <img src="{{ asset('storage/images/'.\auth::user()->id.'.jpg')}}" class="user img-thumbnail" style="" />
          @elseif(\Storage::disk('public')->exists('images/'.\auth::user()->id.'.jpeg'))
            <img src="{{ asset('storage/images/'.\auth::user()->id.'.jpeg')}}" class="user img-thumbnail"  />
          @elseif(\Storage::disk('public')->exists('images/'.\auth::user()->id.'.png'))
              <img src="{{ asset('storage/images/'.\auth::user()->id.'.png')}}" class="user img-thumbnail"  />
          @else
              <img src="{{ asset('images/admin/user.png')}}" class="user "  />
          @endif
        </div>
        <div class="card-body pt-0 text-center mb-3">
          <div class="h4 mb-2 mt-4">Hi, {{ \auth::user()->name}}! </div>
          <div class="mb-4 h2"><span class="badge badge-warning">Trainer</span></div>
          <p class="p-4">Develop a passion for learning. If you do, you will never cease to grow <br><span class="text-secondary">-Anthony J Dangelo</span></p>
          <a href="{{ route('useredit')}}">
          <button class="btn btn-primary">Edit</button></a>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <button class="btn btn-success">Logout</button>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        
      </div>
    </div>

            

            

             <div class=" text-light rounded p-4 mb-4" style="background-color: #55a95f">
                <h3 class="mb-0"><i class="fa fa-envelope-o"></i> Messages  </h3>
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

        @if(\auth::user()->admin!=4 )

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

       <div class="col-4 col-md-4 col-lg-3">
            <a href="{{ route('user.index') }}">
            <div class="border-top bg-white p-4   mr-0 mr-md-4">
                <div>
                    <div class="text-center h4 mb-4">Students</div>
                    <img src="{{ asset('images/admin/users.png') }}" class="w-100 mb-2" >
                    
                </div>
            </div>
            
            </a>
        </div>


         <div class="col-4 col-md-4 col-lg-3">
            <a href="{{ route('test.index') }}">
            <div class="border-top bg-white p-4   mr-0 mr-md-4">
                <div>
                    <div class="text-center h4 mb-4">Tests</div>
                    <img src="{{ asset('images/admin/test.png') }}" class="w-100 mb-2" >
                    
                </div>
            </div>
            
            </a>
        </div>

        <div class="col-4 col-md-4 col-lg-3">
            <a href="{{ route('track.index') }}">
            <div class="border-top bg-white p-4   mr-0 mr-md-4">
                <div>
                    <div class="text-center h4 mb-4">Batches</div>
                    <img src="{{ asset('images/admin/category.png') }}" class="w-100 mb-2" >
                    
                </div>
            </div>
            
            </a>
        </div>

        <div class="col-4 col-md-4 col-lg-3">
            <a href="{{ route('file.index') }}">
            <div class="border-top bg-white p-4   mr-0 mr-md-4">
                <div>
                    <div class="text-center h4 mb-4">Resources</div>
                    <img src="{{ asset('images/admin/products.png') }}" class="w-100 mb-2" >
                    
                </div>
            </div>
            </a>
        </div>


    </div>

@if(\auth::user()->admin==4)


<div class="bg-white p-4 mt-4 rounded">
    <h3 class="mb-4"><i class="fa fa-gg"></i> Tests Attempted
    <span class="badge badge-warning float-right">{{ $data['attempt_total'] }}</span>
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

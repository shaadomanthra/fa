@extends('layouts.app')
@include('meta.index')
@section('content')

<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    @if($employ)
    <li class="breadcrumb-item"><a href="{{ route('prospect.dashboard')}}">{{ ucfirst($app->module) }} - Dashboard</a></li>
     <li class="breadcrumb-item">{{ $employ->name }}</li>
    @else
     <li class="breadcrumb-item">{{ ucfirst($app->module) }} - Dashboard</li>
    @endif
  </ol>
</nav>

@include('flash::message')

<p class="h1 mb-4 text-secondary"><b><i class="fa fa-user-circle-o "></i> 
@if($employ) {{$employ->name}} @else Prospect @endif
 Dashboard </b> 

<div class='wrap'>
        <div class="row">
            <div class="col-6 col-md-3 mb-4">
              <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">All</h5>
                <div class="display-4 text-center">{{ $counter['all']}}</div>
              </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
             <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">Enquiry</h5>
                <div class="display-4 text-center">{{ $counter['enquiry']}}</div>
              </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
              <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">Demo</h5>
                <div class="display-4 text-center">{{ $counter['demo']}}</div>
              </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
              <div class="rounded p-3 " style="background: #cdfbe1; border:1px solid #c1efd5">
                <h5 class="text-center">Enrolled</h5>
                <div class="display-4 text-center">{{ $counter['enrolled']}}</div>
              </div>
            </div>
        </div>
    </div>
<div  class="row ">
@if(!$employ)
  <div class="col-12 col-md-6">

     @if(count($employees))
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Counsellor </th>
                <th scope="col">All</th>
                <th scope="col">Enquiry</th>
                <th scope="col">Demo</th>
                <th scope="col">Enrolled </th>
              </tr>
            </thead>
            <tbody>
              @foreach($employees as $key=>$employee)  
              @if(isset($counter[$employee->id]))
              <tr>
                <th scope="row">{{  $key+1 }}</th>
                <td>
                  <a href="{{ route('prospect.dashboard')}}?user_id={{$employee->id}}">
                    @if(\Storage::disk('public')->exists('images/'.$employee->id.'.jpg')) 
         <img src="{{ asset('storage/images/'.$employee->id.'.jpg')}}" class="user " style="width:15px;height:15px;border-radius: 10px;" />
          @elseif(\Storage::disk('public')->exists('images/'.$employee->id.'.jpeg'))
            <img src="{{ asset('storage/images/'.$employee->id.'.jpeg')}}" class="user "  style="width:15px;height:15px;border-radius: 10px;"/>
          @elseif(\Storage::disk('public')->exists('images/'.$employee->id.'.png'))
              <img src="{{ asset('storage/images/'.$employee->id.'.png')}}" class="user "  style="width:15px;height:15px;border-radius:10px;"/>
          @else
              <img src="{{ asset('images/admin/user.png')}}" class="user mt-0" style="width:15px" />
          @endif
                  {{ $employee->name }}
                  </a>
                </td>
                <td>{{ $counter[$employee->id]['all'] }}</td>
                 <td>{{ $counter[$employee->id]['enquiry'] }}</td>
                  <td>{{ $counter[$employee->id]['demo'] }}</td>
                   <td>{{ $counter[$employee->id]['enrolled'] }}</td>
                
                
              </tr>
              @endif
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No {{ $app->module }} found
        </div>
        @endif
    
 </div>
@endif
  <div class="col-12 col-md">
 
    <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <nav class="navbar navbar-light bg-light justify-content-between border mb-3">
          <div class="navbar-brand"><i class="fa fa-bars"></i> {{ ucfirst($app->module) }} ({{$objs->total()}}) <a href="{{route($app->module.'.create')}}">
              <button type="button" class="btn btn-secondary my-2 my-sm-2 mr-sm-3 pl-1 pr-1 pt-0 pb-0"><i class="fa fa-plus"></i></button>
            </a></div>
          @can('create',$obj)
            <a href="{{route($app->module.'.index')}}@if($employ)?user_id={{$employ->id}} @endif">
              <button type="button" class="btn btn-success my-2 my-sm-2 ">View All</button>
            </a>

            @endcan
          
        </nav>

        <div id="search-items">
        
 @if($objs->total()!=0)
        <div class="table-responsive">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Source</th>
                <th scope="col">Stage</th>
                <th scope="col">Followup</th>
                <th scope="col">Created </th>
              </tr>
            </thead>
            <tbody>
              @foreach($objs as $key=>$obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  <a href=" {{ route($app->module.'.show',$obj->id) }} ">
                  {{ $obj->name }}
                  </a>
                </td>
                <td>
                 {{ ucfirst($obj->source) }}
               
                </td>
                <td>
                  @if($obj->stage=='enquiry')
                  <span class="badge badge-warning">{{ $obj->stage }}</span>
                  @elseif($obj->stage=='demo')
                  <span class="badge badge-primary">{{ $obj->stage }}</span>
                  @else
                  <span class="badge badge-success">{{ $obj->stage }}</span>
                  @endif
                </td>

                <td>{{ count($obj->followups) }}</td>
                <td>{{ ($obj->created_at) ? $obj->created_at->diffForHumans() : '' }}</td>
                
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
        @else
        <div class="card card-body bg-light">
          No {{ $app->module }} found
        </div>
        @endif

       </div>

     </div>
   </div>
 </div>
 
 
</div>

@endsection



@extends('layouts.app')
@include('meta.index')
@section('content')

<div aria-label="">
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
</div>



@include('flash::message')

<p class="h3 mb-4 text-secondary"><b><i class="fa fa-user-circle-o "></i> 
@if($employ) {{$employ->name}} @else Prospect @endif
 Dashboard </b> 
  <div class="input-group mb-3 ">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Filter</label>
  </div>
  <select class="custom-select range" id="inputGroupSelect01" name="range" data-url="{{ route('prospect.dashboard')}}?@if($employ)user_id={{$employ->id}}@endif">
    <option value="" @if(request()->get('range')=='') selected @endif>Over All</option>
    <option value="thisweek" @if(request()->get('range')=='thisweek') selected @endif>This Week</option>
    <option value="lastweek" @if(request()->get('range')=='lastweek') selected @endif>Last Week</option>
    <option value="thismonth" @if(request()->get('range')=='thismonth') selected @endif>This Month</option>
    <option value="lastmonth" @if(request()->get('range')=='lastmonth') selected @endif>Last Month</option>
    <option value="thisyear" @if(request()->get('range')=='thisyear') selected @endif>This Year</option>
    <option value="lastyear" @if(request()->get('range')=='lastyear') selected @endif>Last Year</option>
  </select>
</div>
</p>

<div class='wrap'>
        <div class="row">
            <div class="col-6 col-md-3 mb-4">
              <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">All</h5>
                <div class="display-4 text-center">
                <a href="{{route('prospect.index')}}?@if(request()->get('range'))range={{request()->get('range')}}@endif @if(request()->get('user_id'))&user_id={{request()->get('user_id')}}@endif @if(request()->get('stage'))&stage={{request()->get('stage')}}@endif">
                {{ $counter['all']}}
                </a>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
             <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">Enquiry</h5>
                <a href="{{route('prospect.index')}}?stage=enquiry&@if(request()->get('range'))range={{request()->get('range')}}@endif @if(request()->get('user_id'))&user_id={{request()->get('user_id')}}@endif">
                <div class="display-4 text-center">{{ $counter['enquiry']}}</div>
                </a>
              </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
              <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">Invited</h5>
                <a href="{{route('prospect.index')}}?stage=invited&@if(request()->get('range'))range={{request()->get('range')}}@endif @if(request()->get('user_id'))&user_id={{request()->get('user_id')}}@endif">
                <div class="display-4 text-center">{{ $counter['invited']}}</div>
              </a>
              </div>
            </div>
            <div class="col-6 col-md-2 mb-4">
              <div class="rounded p-3 " style="background: #e6f6ff; border:1px solid #cee1eb">
                <h5 class="text-center">Demo</h5>
                <a href="{{route('prospect.index')}}?stage=demo&@if(request()->get('range'))range={{request()->get('range')}}@endif @if(request()->get('user_id'))&user_id={{request()->get('user_id')}}@endif">
                <div class="display-4 text-center">{{ $counter['demo']}}</div>
              </a>
              </div>
            </div>
            <div class="col-6 col-md-3 mb-4">
              <div class="rounded p-3 " style="background: #cdfbe1; border:1px solid #c1efd5">
                <h5 class="text-center">Enrolled</h5>
                <a href="{{route('prospect.index')}}?stage=enrolled&@if(request()->get('range'))range={{request()->get('range')}}@endif @if(request()->get('user_id'))&user_id={{request()->get('user_id')}}@endif">
                <div class="display-4 text-center">{{ $counter['enrolled']}}</div>
                </a>
              </div>
            </div>
        </div>
    </div>
<div  class="row ">

  <div class="col-12 col-md-6 mb-4">
@if(!$employ)
     @if(count($employees))
        <div class="table-responsive mb-4">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Counsellor </th>
                <th scope="col">All</th>
                <th scope="col">Enquiry</th>
                <th scope="col">Invited</th>
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
                <td><a href="{{route('prospect.index')}}?user_id={{$employee->id}}&@if(request()->get('range'))range={{request()->get('range')}}@endif">{{ $counter[$employee->id]['all'] }}</a></td>
                 <td><a href="{{route('prospect.index')}}?user_id={{$employee->id}}&stage=enquiry& @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $counter[$employee->id]['enquiry'] }}</a></td>
                 <td><a href="{{route('prospect.index')}}?user_id={{$employee->id}}&stage=invited& @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $counter[$employee->id]['invited'] }}</a></td>
                  <td><a href="{{route('prospect.index')}}?user_id={{$employee->id}}&stage=demo& @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $counter[$employee->id]['demo'] }}</a></td>
                   <td><a href="{{route('prospect.index')}}?user_id={{$employee->id}}&stage=enrolled& @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $counter[$employee->id]['enrolled'] }}</a></td>
                
                
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
@endif

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

  <div class="col-12 col-md">
 
  @if(!$employ) 
     @if(count($employees))
        <div class="table-responsive mb-4">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Counsellor </th>
                <th scope="col">Prospect Followup</th>
                <th scope="col">Total Followups</th>
                <th scope="col">Open</th>
                <th scope="col">Incomplete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($employees as $key=>$employee)  
              @if(isset($followup_counter[$employee->id]))
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
                <td><a href="{{route('followup.index')}}?user_id={{$employee->id}}& @if(request()->get('range'))range={{request()->get('range')}}@endif">{{ $followup_counter[$employee->id]['prospects'] }}</a></td>
                 <td><a href="{{route('followup.index')}}?user_id={{$employee->id}}&view=all&@if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $followup_counter[$employee->id]['followup'] }}</a></td>
                 <td><a href="{{route('followup.index')}}?user_id={{$employee->id}}&state=1& @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $followup_counter[$employee->id]['open'] }}</a></td>
                  <td><a href="{{route('followup.index')}}?user_id={{$employee->id}}&state=2 @if(request()->get('range')) range={{request()->get('range')}}@endif">{{ $followup_counter[$employee->id]['incomplete'] }}</a></td>
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
@endif

         <div class="card mb-3 mb-md-0">
      <div class="card-body mb-0">
        <nav class="navbar navbar-light bg-light justify-content-between border mb-3">
          <div class="navbar-brand"><i class="fa fa-bars"></i> Followups ({{$followup_all->total()}}) <a href="{{route('followup.create')}}">
              <button type="button" class="btn btn-secondary my-2 my-sm-2 mr-sm-3 pl-1 pr-1 pt-0 pb-0"><i class="fa fa-plus"></i></button>
            </a></div>
          @can('create',$obj)
            <a href="{{route('followup.index')}}@if($employ)?user_id={{$employ->id}} @endif">
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
                <th scope="col">Prospect Name </th>
                <th scope="col">Counsellor</th>
                <th scope="col">Comment</th>
                <th scope="col">Scheduled for</th>
              </tr>
            </thead>
            <tbody>
              @foreach($followup_all as $key=>$obj)  
              <tr>
                <th scope="row">{{ $objs->currentpage() ? ($objs->currentpage()-1) * $objs->perpage() + ( $key + 1) : $key+1 }}</th>
                <td>
                  @if(isset($obj->prospect))
                  <a href=" {{ route('prospect.show',$obj->prospect_id) }} ">
                  {{ $obj->prospect->name }} @if($obj->state)<span class="badge badge-warning">open</span>@endif
                  </a>
                  @endif
                </td>
                <td>
                 <a href=" {{ route('followup.index') }}?user_id={{$obj->user->id}} @if(request()->get('today'))&today=1 @endif ">
                  {{ $obj->user->name }}
                </a>
               
                </td>
                <td>
                 {{ $obj->comment }}
               
                </td>
                <td>
                  @if($obj->schedule){{ \Carbon\Carbon::parse($obj->schedule)->format('Y-m-d') }}@endif
                </td>
                
                
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



@extends('layouts.app')
@section('title', $obj->name.' - Ques Analytics | First Academy')
@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb border bg-light">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route($app->module.'.index') }}">{{ ucfirst($app->module) }}</a></li>
    <li class="breadcrumb-item">{{ $obj->name }} - Question Analytics</li>
  </ol>
</nav>


@include('flash::message')
  <div class="row">
    <div class="col-12 col-md-9">
      <div class="card  mb-3">
        <div class="card-body text-secondary pb-0">
          <p class="h2 mb-0">
            <p class="h2 "><i class="fa fa-bar-chart "></i> {{ $obj->name }}  @if(request()->get('today'))
            <span class="badge badge-warning ">Today</span>
            
            @elseif(request()->get('from'))
            <span class="badge badge-warning ">Range</span>
            @elseif(request()->get('all'))
            <span class="badge badge-warning ">ALL</span>
            @else
            @endif
            <a href="{{ route('test.qanalytics',$obj->id)}}?all=1" class="btn btn-success float-right">View All</a>
            <a href="{{ route('test.qanalytics',$obj->id)}}?today=1&all=1" class="btn btn-outline-success float-right mr-2">Today</a>
            </p>
            


            <hr>

                 <form method="get" action="{{ route('test.qanalytics',$obj->id)}}">
            <div class="form-row mb-0">

    <div class="col-5 pb-0 mb-0">
      <label class="sr-only" for="inlineFormInputGroup">FROM</label>
      <div class="input-group mb-0">
        <div class="input-group-prepend">
          <div class="input-group-text">FROM</div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup" name='from' value="@if(request()->get('from')){{request()->get('from')}} @endif" placeholder="YYYY-MM-DD">
      </div>
    </div>
       <div class="col-5 pb-0 mb-0">
      <label class="sr-only" for="inlineFormInputGroup">TO</label>
      <div class="input-group mb-0">
        <div class="input-group-prepend">
          <div class="input-group-text">TO</div>
        </div>
        <input type="text" class="form-control" id="inlineFormInputGroup" name='to' value="@if(request()->get('to')){{request()->get('to')}} @endif" placeholder="YYYY-MM-DD">
      </div>
    </div>
   
    <div class="col-md-2 pb-0">
      <input type="hidden"  name='all' value="1" >
      <button class='btn btn-primary w-100'>Submit</button>
    </div>
  </div>
</form>
            
          </p>
        </div>
      </div>


      <div class="">
      @if((count($data['mcq']) + count($data['fillup']))!=0)
        <div class="table-responsive ">

<table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col" style='width:70%'>Question</th>
      <th scope="col">Analysis <span class='float-right'><i class="fa fa-user"></i> {{$total}}</span></th>
    </tr>
  </thead>
  <tbody class="{{$i=1}}">
    @foreach($data['q'] as $q=>$item)
    <tr>
      <th scope="row">{{$q}}</th>
      <td>@if($item['type']=='fillup')
          @if($item['ques']->label)<b class=''>{{$item['ques']->label}}</b> @endif
          <div>
          @if($item['ques']->prefix)<span>{{$item['ques']->prefix}}</span> @endif
          @if($item['ques']->answer)<span class="text-success "><b><u>{{$item['ques']->answer}}</u></b></span> @endif
          @if($item['ques']->suffix)<span>{{$item['ques']->suffix}}</span> @endif
          </div>
        @else
          @if($item['ques']->question)<b class='h6' style="line-height: 1.5">{!! $item['ques']->question !!}</b> @endif
          <div>
          @if($item['ques']->a)<div class="@if(strpos($item['ques']->answer, 'A') !== FALSE) text-success @endif">(A){{$item['ques']->a}}</div> @endif
          @if($item['ques']->b)<div class="@if(strpos($item['ques']->answer, 'B') !== FALSE) text-success @endif">(B){{$item['ques']->b}}</div> @endif
          @if($item['ques']->c)<div class="@if(strpos($item['ques']->answer, 'C') !== FALSE) text-success @endif">(C){{$item['ques']->c}}</div> @endif
          @if($item['ques']->d)<div class="@if(strpos($item['ques']->answer, 'D') !== FALSE) text-success @endif">(D){{$item['ques']->d}}</div> @endif
          @if($item['ques']->e)<div class="@if(strpos($item['ques']->answer, 'E') !== FALSE) text-success @endif">(E){{$item['ques']->e}}</div> @endif
          @if($item['ques']->f)<div class="@if(strpos($item['ques']->answer, 'F') !== FALSE) text-success @endif">(F){{$item['ques']->f}}</div> @endif
          @if($item['ques']->g)<div class="@if(strpos($item['ques']->answer, 'G') !== FALSE) text-success @endif">(G){{$item['ques']->g}}</div> @endif
          @if($item['ques']->h)<div class="@if(strpos($item['ques']->answer, 'H') !== FALSE) text-success @endif">(H){{$item['ques']->h}}</div> @endif
          @if($item['ques']->i)<div class="@if(strpos($item['ques']->answer, 'I') !== FALSE) text-success  @endif">(I){{$item['ques']->i}}</div> @endif
          </div>
        @endif</td>
      <td><span class="" style="color: #65ca65"><i class="fa fa-check-circle"></i> {{$item['correct']}}</span> &nbsp;&nbsp;<span class="float-right" style="color: #f16767"><i class="fa fa-times-circle"></i> {{$item['incorrect']}}</span><br>

      <div class="progress" style='height:5px;'>
		  <div class="progress-bar" role="progressbar" style="width: {{($item['correct']/$total)*100}}%;background-color: #65ca65" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
		  <div class="progress-bar " role="progressbar" style="width: {{($item['incorrect']/$total)*100}}%;background-color: #eb9191" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	  </td>
    </tr>
   
    @endforeach
    
  </tbody>
</table>
        </div>
        @else
        <div class="p-3 border rounded">No Data</div>
        @endif
      </div> 
    </div>
    <div class="col-12 col-md-3">
      @include('appl.test.snippets.menu')
    </div>
</div> 
@endsection
@extends('layouts.bg')
@section('title', $obj->name.' - Score Analytics | First Academy')
@section('content')

<style>
.box{ background: #f9f9f9;
box-shadow: 1px 1px 1px  1px  silver; border-radius:5px;padding: 15px;float: right; }
</style>
<div class="bg-white py-2 mb-4">
  <div class="container">


    <div class="mb-3 mt-4 row">
      <div class="col-12 col-md-6 ">
      <h2 class="mt-4"><i class="fa fa-bar-chart "></i> {{ $obj->name }}  </h2>
      <a href="{{ route('test',$app->test->slug)}}"><i class="fa fa-angle-left"></i> back to test</a>
     </div>
      <div class="col-12 col-md-6 ">
        <div class=" float-right box text-center">
          <div class=" h5 mb-0">
                Participants
             
            </div>
         <div class="mt-2 display-4">{{ $users['participants'] }}</div>

       </div>
     </div>

     

   </div>

 </div>
</div>


<div class="container">
@include('flash::message')
  <div class="row ">
    <div class="col-12 col-md-6">
      


     
      <div class="mt-4 mb-4">
      @if($users['participants']!=0)
        <h3 class="mb-4"><i class="fa fa-user"></i> User Analytics</h3>
        <div class="table-responsive ">

<table class="table table-bordered bg-white">
  <thead class="bg-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Participant</th>
      @if($obj->testtype->name!='WRITING' && $obj->testtype->name!='SPEAKING')
      <th scope="col">Score</th>
      @endif
    </tr>
  </thead>
  <tbody class="{{$i=1}}">
    @foreach($score as $k=>$s)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>
        @if($app->test->status==2)
        <a href="{{ route('test.analysis',$app->test->slug)}}?session_id={{$users[$k]['id']}}">{{ $users[$k]['session']['name']}}</a>
        @else
        <a href="{{ route('user.show',$users[$k]['user']['id'])}}">{{ $users[$k]['user']['name']}}</a>
        @endif
      </td>

      @if($obj->testtype->name!='WRITING' && $obj->testtype->name!='SPEAKING')
      <td>{{ $s}}</td>
      @endif
    </tr>
    @if($i==6 && !request()->get('all'))
      @break
    @endif
    @endforeach
    
  </tbody>
</table>
        </div>
        @endif
      </div> 
    </div>
    <div class="col-12 col-md-6">

      <div class="mt-4 mb-4">
      @if((count($data['mcq']) + count($data['fillup']))!=0)
      <h3 class="mb-4"><i class="fa fa-gg"></i> Question Analytics</h3>
        <div class="table-responsive ">

<table class="table table-bordered bg-white">
  <thead class="bg-light">
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
</div> 
</div>
@endsection
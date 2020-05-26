@extends('layouts.bg')
@section('title', $obj->name.' - Score Analytics | '.getenv('APP_NAME'))
@section('content')

<style>
.box{ background: #f9f9f9;
box-shadow: 1px 1px 1px  1px  silver; border-radius:5px;padding: 15px; }
.f12{font-size: 12px;margin-top: 3px; color: silver}
</style>
<div class="bg-white py-2 mb-4">
  <div class="container px-4 px-md-0">


    <div class="mb-3 mt-4 row">
      <div class="col-12 col-md-6 ">
      <h2 class="mt-4 "><i class="fa fa-bar-chart "></i> {{ $obj->name }}  </h2>
      <a href="{{ route('test',$app->test->slug)}}" class=""><i class="fa fa-angle-left"></i> back to test</a>
     </div>
      <div class="col-12 col-md-6 ">
        <div class=" float-md-right box text-center mt-4 mt-md-0">
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
    @if($i==6 && request()->get('top5'))
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
          @if($item['ques']->question)<div class="mb-2"><b class='h6' style="line-height: 1.5">{!! $item['ques']->question !!}</b></div> @endif
          <div>
          @if($item['ques']->layout!='gre_numeric' && $item['ques']->layout!='gre_fraction' && $item['ques']->layout!='gre_sentence')
          @foreach(['a','b','c','d','e','f','g','h','i'] as $opt)
            @if(isset($item['ques']->$opt))
            @if($item['ques']->$opt || $item['ques']->$opt==='0' )<div class="@if(strpos($item['ques']->answer, strtoupper($opt)) !== FALSE) text-success @endif  p-1 mb-1 rounded" style="background: linear-gradient(90deg, @if(strpos($item['ques']->answer, strtoupper($opt)) !== FALSE) #dbf2d9 @else #ffdbdb @endif {{$data['percent'][$q][strtoupper($opt)]}}%, #f9f9f9 0%)">({{strtoupper($opt)}}){{$item['ques']->$opt}} <span class="float-right f12">{{$data['percent'][$q][strtoupper($opt)]}}%</span></div> @endif
            @endif

          @endforeach
          @elseif($item['ques']->layout=='gre_numeric')
          <div class="p-1">Answer: &nbsp;<b>{{$item['ques']['a']}}</b></div>
          @elseif($item['ques']->layout=='gre_fraction')
          <div class="p-1">Answer: &nbsp;<b>{{$item['ques']['a']}}/{{$item['ques']['b']}}</b></div>
          @endif
          


          
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
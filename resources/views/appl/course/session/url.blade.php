@extends('layouts.app')
@section('title', $obj->name.' | First Academy')
@section('description', 'Take a free IELTS | OET test completely free. Full-length OET practice test for free! Free IELTS writing band scores. Test your vocabulary for OET and IELTS.')
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')


@include('flash::message')

  <div class="row">

    <div class="col-md-12">
      <div class="card bg-light mb-3">
        <div class="card-body text-secondary">
          <p class="h2 mb-0"><i class="fa fa-th "></i> {{$obj->track->name}} - {{ $obj->name }} 

         
          </p>
        </div>
      </div>

     
      <div class="card mb-4">
        <div class="card-body">
          @if($obj->status)
          <div class="mb-4">{!! $obj->description !!}</div>
          @if($obj->users->contains(\auth::user()->id))
            @if($obj->meeting_url)
                <a href="{{ $obj->meeting_url}}" class="btn btn-primary btn-lg">Zoom Meeting URL</a>
            @else
            <div class="p-3 bg-light border">
              <b>Meeting ID:</b> {{$obj->meeting_id}}<br>
              <b>Meeting password:</b> {{$obj->meeting_password}}<br>
              <b>Website:</b> <a href="https://zoom.us/join">zoom.us/join</a><br>
            </div>

            @endif
          @else
            <a href="{{ route('session.join',$obj->slug)}}" class="btn btn-primary btn-lg">Accept and Join Session</a>
          @endif
          
          @else
          <div class="mb-0">The session is closed.</div>
          @endif
          </div>
      </div>

    </div>

     

  </div> 





@endsection
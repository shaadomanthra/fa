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
          <p class="h2 mb-0"><i class="fa fa-exclamation-triangle "></i> No Access - {{$obj->track->name}} - {{ $obj->name }} 

         
          </p>
        </div>
      </div>

     
      <div class="card mb-4">
        <div class="card-body">
         You are not authorized to attend this session. Kindly talk to helpdesk for further details.
          </div>
      </div>

    </div>

     

  </div> 





@endsection
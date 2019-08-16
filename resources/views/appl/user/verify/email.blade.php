@extends('layouts.app')
@section('title', 'Email Verification')
@section('content')

@include('flash::message')
<div class="bg-white">
<div class="card-body p-4 ">
@if($user->activation_token==1)
	<h1>Email Verified </h1>
	<p>Your account ({{$user->email}}) is active!</p>
@else
	<h3>Verify your email id</h3>
	<p>We have sent you an activation email, kindly click on the activation link to verify your email.</p>
	<a href="{{ route('email.sendcode') }}?resend=1">
	<button class="btn btn-success">Resend email</button>
	</a>

	<hr>
	<p>Incase of any error, kindly contact the adminstrator, the contact details are mentioned in this <a href="{{ route('contact')}}">link</a></p>
@endif
</div>		
</div>
@endsection           
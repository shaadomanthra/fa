

@extends('layouts.app')
@section('title','Admin Contact - First Academy' )
@section('keywords', '')
@section('content')


<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-success"><i class="fa fa-check-circle"></i> Successfully sent message</h1>
<hr>

<p> Your message has been sent to the administrator. <br>You can expect a reply within 48 hours. Incase of emergency kindly reach out First Academy team at +91 98666 88666</p>

<a href="{{ route('login') }}">
<button class="btn btn-primary btn-lg">Login</button>
</a>

</div>
</div>
@endsection
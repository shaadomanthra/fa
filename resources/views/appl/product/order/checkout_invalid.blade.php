
@extends('layouts.app')
@section('title','Checkout Invalid - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')


<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-danger"><i class="fa fa-check-circle"></i> Invalid checkout</h1>
<hr>

<p> This checkout is invalid. Kindly contact the adminstrator, the contact details are mentioned in this <a href="{{ route('contact')}}">link</a></p>

</div>
</div>
@endsection
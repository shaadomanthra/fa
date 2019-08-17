
@extends('layouts.app')
@section('title','Free Access - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')
<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-primary"><i class="fa fa-check-circle"></i> Free Access</h1>
<hr>

<p>  The following test ({{$test->name}}) is a part of our free product ({{$product->name}}).<hr>Kindly click on the below button to get the access. </p>

<a href="{{ route('test',$test->slug) }}?product={{$product->slug}}&grantaccess=1">
<button class="btn btn-outline-primary btn-lg"> Access Now</button>
</a>

</div>
</div>
@endsection
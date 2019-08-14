
@extends('layouts.app')
@section('title','Purchase - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET)
@section('content')
<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-primary"><i class="fa fa-times-circle"></i> Restricted Access</h1>
<hr>

<p>  The following test ({{$test->name}}) is a part of our premium product ({{$product->name}}).<hr>Kindly purchase the product to continue further. </p>

<a href="{{ route('product.view',$product->slug) }}">
<button class="btn btn-outline-primary btn-lg"> Buy Now</button>
</a>

</div>
</div>
@endsection

@extends('layouts.app')
@section('title','Checkout Denail - First Academy' )
@section('keywords', 'IELTS Practice Test, OET Practice Online, OET Online Training, Vocabulary for IELTS, Vocabulary for OET')
@section('content')


<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-danger"><i class="fa fa-times-circle"></i> Order Denial</h1>
<hr>

<p>  You have already purchased this package ({{$order->order_id}}) with us  {{ $order->created_at->diffForHumans()}}. <hr>Kindly contact the adminstrator, the contact details are mentioned in this <a href="#">link</a></p>

</div>
</div>
@endsection
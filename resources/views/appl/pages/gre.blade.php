@extends('layouts.app')
@section('title', 'Contact Us ')
@section('content')

<div class="border p-3 rounded mb-4">
	<h3> {{$category->value}}</h3>
</div>
<style>
	ol{ list-style: none }
</style>
@foreach($ques as $k => $q)
	@if($q->passage())
	<div class="bg-light p-3 border mb-3">{!! $q->passage() !!}</div>
	@endif
	<h5>({{($k+1)}}) {!! $q->question !!}</h5>
	(A) {!! $q->a !!}<br>
	(B) {!! $q->b !!}<br>
	(C) {!! $q->c !!}<br>
	(D) {!! $q->d !!}<br>
	(E) {!! $q->e !!}<br>
	<hr>
@endforeach
@endsection

@extends('layouts.app')

@section('content')


<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-danger"><i class="fa fa-check-circle"></i> Error</h1>
<hr>

<p> {!!  $message !!}</p>
<hr>
<a href="{{ url()->previous() }}">
<button class="btn btn-outline-primary btn-sm"> Back</button>
</a>
</div>
</div>
@endsection
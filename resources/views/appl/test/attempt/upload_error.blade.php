
@extends('layouts.app')

@section('content')


<div class="bg-white">
<div class="card-body p-4 ">
<h1 class="text-danger"><i class="fa fa-times-circle"></i> Invalid file type</h1>
<hr>

<p>  The following file type (<b>{{$extension}}</b>) is not supported. <hr>Kindly contact the adminstrator for further quieries.</p>
<a href="{{ url()->previous() }}">
<button class="btn btn-outline-primary btn-sm"> Back</button>
</a>
</div>
</div>
@endsection
@extends('layouts.app')


@section('content')
<nav aria-label="">
  <ol class="breadcrumb p-0 pb-3 m-2" style="background: transparent;">
    <li class="breadcrumb-item"><a href="{{ url('/home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}"> Blog </a> </li>
    <li class="breadcrumb-item"> Tooltip  </li>
  </ol>
</nav>
@include('flash::message')
<div  class="row ">

  <div class="col-12 col-md-9">
<form action="{{ route('tooltip')}}" method="post">
<textarea id="code" class="form-control code" name="code"  rows="10">{{$code}}</textarea>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="filename" value="{{ $filename }}">
<button type="submit" class="btn btn-lg btn-primary mt-4 runcode" >Save</button>
</form>
</div>

<div class="col-12 col-md-3">
	 @auth
  @if(\auth::user()->isAdmin())
    @include('appl.blog.snippets.menu')
  @endif
  @endauth
</div>

</div>
@endsection
@extends('layouts.app')

@section('content')
<form action="{{ route('editor.page')}}" method="post">
<textarea id="code" class="form-control code" name="code"  rows="10">{{$code}}</textarea>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="filename" value="{{ $filename }}">
<button type="submit" class="btn btn-lg btn-primary mt-4 runcode" >Save</button>
</form>
@endsection
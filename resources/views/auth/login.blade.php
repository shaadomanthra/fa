@extends('layouts.login')
@section('title', 'Login | First Academy')
@section('description', 'Log in using the email address and password you registered with in order to access your practice tests at first academy.')
@section('keywords', 'Login, login first academy, register first academy')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4"> 
<form class="form-signin bg-white border rounded p-4" method="POST" action="{{ route('login') }}">

    @csrf
    <img class="mb-4 mt-4" src="{{ asset('images/logo.png') }}" alt="" width="250" >
    <hr>
    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
    <h1 class="h4 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>

    <input id="email" type="email" class="form-control mb-3 p-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <label for="inputPassword" class="sr-only">Password</label>

    <input id="password" type="password" class="form-control p-3 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="checkbox mb-3">
        <label>
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </label>
    </div>
    <button class="btn btn-lg btn-primary " type="submit">Sign in</button>
    <a href="{{ route('register') }}">
        <button class="btn btn-lg btn-success" type="button">Register</button>
    </a>
    @if (Route::has('password.request'))
    <a class="btn btn-link mt-2" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif

    <p class="mt-5 mb-3 text-muted">&copy; First Academy</p>
</form>
</div>
</div>
</div>
@endsection
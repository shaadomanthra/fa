<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#0d8d98">
    <!-- CSRF Token -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="First Academy Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @if(isset($player))
    <link rel='stylesheet' href='{{ asset("css/player.css") }}'>
    @endif
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Anton|Bungee+Outline|Muli&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    @if(isset($editor))
    <link href="{{asset('js/summernote/summernote-bs4.css')}}" rel="stylesheet">
    @endif
    @if(isset($try) || isset($reading))
    <link rel='stylesheet' href='{{ asset("css/try.css") }}'>
    @endif
    <style>
.bg{
    background: 
    radial-gradient(#0d8d98 3px, transparent 4px),
    radial-gradient(#0d8d98 3px, transparent 4px),
    linear-gradient(#0a838e 4px, transparent 0),
    linear-gradient(45deg, transparent 74px, transparent 75px, #0d8d98 75px,#0d8d98 76px, transparent 77px, transparent 109px),
    linear-gradient(-45deg, transparent 75px, transparent 76px, #0d8d98 76px, #0d8d98 77px, transparent 78px, transparent 109px),
  #0a838e;
  background-size: 109px 109px, 109px 109px,100% 6px, 109px 109px, 109px 109px;
  background-position: 54px 55px, 0px 0px, 0px 0px, 0px 0px, 0px 0px;
}
</style>
</head>
<body style="background-color: white">
    <div id="app">

        <main class="">
            @yield('content')
        </main>
        <footer class="bg-white">
            <div class="container">
            @include('layouts.footer')
        </div>
        </footer>
        
    </div>
    @include('layouts.script')
</body>
</html>

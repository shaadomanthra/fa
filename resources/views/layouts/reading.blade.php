<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta name="description" content="Online Test engine for GRE, IELTS, TOEFL, PTE and OTE by First Academy">
    <meta name="author" content="Krishna Teja G S">
    <title>First Academy Online Tests for GRE, IELTS, TOEFL, PTE, OTE</title>
    @if(isset($player))
    <link rel='stylesheet' href='{{ asset("css/player.css") }}'>
    @endif
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
    @if(isset($editor))
    <link href="{{asset('js/summernote/summernote-bs4.css')}}" rel="stylesheet">
    @endif
    @if(isset($try) || isset($reading))
    <link rel='stylesheet' href='{{ asset("css/try.css") }}'>
    @endif
    
</head>
<body>
    <div id="app">
        @include('layouts.menu')

        <main class="">
            @yield('content')
        </main>
        

    </div>
    @include('layouts.script')
</body>
</html>

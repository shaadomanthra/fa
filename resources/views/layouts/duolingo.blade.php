<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="First Academy Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/styles.css?new=1') }}" rel="stylesheet">
    @if(isset($editor))
    <link href="{{asset('js/summernote/summernote-bs4.css')}}" rel="stylesheet">
    @endif
    @if(isset($try) || isset($reading) || isset($pte))
    <link rel='stylesheet' href='{{ asset("css/try.css") }}'>
    @endif

    @if(isset($try))
      <script type="text/x-mathjax-config">
          MathJax.Hub.Config({
          extensions: ["tex2jax.js"],
          jax: ["input/TeX","output/HTML-CSS"],
          tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
      });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    @endif

    <style>
        .text-primary{color:#ff8159;}
        b{color:#636569;}
        .lightb{background: #fff3ef;color:#ff5722;}
        input.duo{border-color:#ffd8cb;}
        input.lightb{border-color:#ffd8cb;}
        a.white{color: silver}
        a.white:hover{color: silver}
        a.disabled{color:silver;}
        a.disabled:hover{color:silver;}
        .select_word{border:2px solid silver;}
        .select_word:hover{border-color:#ff8159;cursor: pointer}
        .select_word_selected{background:#ff5722;color:white;border-color:#ff5722;}
        .duo-heading{font-size: 20px}
        .hr{border: 1px solid #faf1eb;margin: 30px 0px}
        .wrap{display: inline}
        .bg-silver{background: #eee}
        .btn-submit-duo{background:#ff5722;color:white; }
        .audioed{ cursor: pointer; }
        .audioitem{border:2px solid silver;border-right:0;padding:8px 13px;border-radius: 5px 0px 0px 5px;}
        .checkitem{border:2px solid silver;padding:8px 12px;border-radius: 0px 5px 5px 0px; color:silver;cursor: pointer;}
        .checkitem_selected{border:2px solid #ff5722; background: #ff5722;color:white;}
        .audioitem_selected{border:2px solid #ff5722;border-right:0;}
    </style>
    
</head>
<body style="background: #eee">
    <div id="app">

        <main class="">
            @yield('content')
        </main>

        
    </div>
    @include('layouts.script')
</body>
</html>

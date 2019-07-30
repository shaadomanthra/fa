<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffc40d">
<meta name="theme-color" content="#ffffff">
    <meta name="description" content="Online Test engine for GRE, IELTS, TOEFL, PTE and OTE by First Academy">
    <meta name="author" content="Krishna Teja G S">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>First Academy Online Tests for GRE, IELTS, TOEFL, PTE, OTE</title>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
      


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
  </head>
  <body class="text-center ">
       @yield('content')
  </body>
</html>


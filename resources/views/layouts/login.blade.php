<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  <body class="text-center bg">
       @yield('content')
  </body>
</html>


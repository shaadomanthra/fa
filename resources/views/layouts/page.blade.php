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
    <meta name="theme-color" content="#71bce2">
    <!-- CSRF Token -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="First Academy Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:800|Roboto:900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/style_page.min.css') }}?new=3" rel="stylesheet">
    <link href="{{ asset('css/sp2.css') }}?new=3" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('layouts.menu')

        @if(request()->segment(1)!='enroll' && request()->segment(1)!='enroll2' )
        <div class='joinnow' style="display:none;padding: 0;position: fixed;
  top: 0;
  left: 0;
  width: 100%;z-index: 10;">
        <div class="p-3 " style="background:#71bce2;">
         <div class=" container text-white" style='padding:0px'>
            <div class="row no-gutters">
                <div class="col-8 col-md-10">
                    <h5 class="mb-0 d-none d-md-block">Join the 20,000+ who have benefitted from First Academy </h5> 
                      <h5 class="mb-0 d-block d-md-none mt-1">Get the score you want! </h5> 
                </div>

                <div class="col-4 col-md-2">
                    <button class="btn btn-warning w-100"><b>Enroll Now</b></button>
                </div>
         </div>
         </div>
        </div>
        @endif
    </div>
        <main class="py-3 py-md-4 container">
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

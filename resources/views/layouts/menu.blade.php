<nav class="navbar navbar-expand-md navbar-dark  shadow-sm" style="background:#71bce2">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="" src="{{ asset('images/logo_white.png') }}" alt="First Academy" width="200" >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home') }}"><i class="fa fa-home"></i> Dashboard </a>
                </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}"><i class="fa fa-cubes"></i> Products</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/test') }}"><i class="fa fa-check-square-o"></i> Tests</a>
                </li>
                

                
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                </li>
                @endif
                @else

                @if(\auth::user()->isAdmin())
                
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class ="fa fa-bars"></i> Prospects <span class="caret"></span>
                    </a>
                        
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('prospect.dashboard') }}"
                           >
                            Prospect Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ route('prospect.index') }}"
                           >
                            Prospect List
                        </a>
                        <a class="dropdown-item" href="{{ route('prospect.create') }}">
                            Create Prospect 
                        </a>
                        <a class="dropdown-item" href="{{ route('followup.index') }}">
                            Followup List
                        </a>
                        <a class="dropdown-item" href="{{ route('followup.create') }}">
                            Create Followup
                        </a>
                    </div>
                </li>
                @endif

                @if(\auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin') }}"><i class="fa fa-adn"></i> Admin</a>
                </li>
                @endif
                
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                        
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('myorders') }}"
                           >
                            My Orders
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- csrf token : make template more dynamic and use in css output 
             csrf_token() generates token on every page   -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Dynamic title using blade | fallback title -->
    <title>{{config('app.name', 'Proagrica Crud Application')}}</title>

    <!-- Styles using asset helper -->
    <link href="{{ asset('css/app.css') }}" rel=" stylesheet ">

    <!-- JS using asset helper | defer so that it loads at the end of the page & doesn't block app rendering-->
    <script src="{{asset('js/app.js')}}" defer></script>

</head>

<body>
    <!-- Navbar Bootstrap template -->
    <nav class="navbar navbar-expand-lg">
        <!-- Wrap in container to center navbar-->
        <div class="container">
            <a class="navbar-brand" href="#">{{config('app.name', 'Proagrica Crud Application')}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Routes to other pages-->
            <div class="form-inline my-2 my-lg-0">
                @if (Route::has('login'))
                <div>
                    @auth
                    <a href="{{ url('/home') }}">Home</a>
                    <!--On-click, it will submit the form below using its ID and not execute a default GET request-->
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    <!--By default the browser will send a GET request but we need a POST request for logging out
                            Use Javascript to create a hidden form that achieves this and be executed instead of the default-->

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none">
                        @csrf

                    </form>

                    @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
                @endif

            </div>
        </div>
    </nav>


    <!-- Second Navbar -->

    <!-- Can the current logged in user pass the gate called logged-in
         If yes, display, otherwise, hide second navbar-->
    @can('logged-in')

    <nav class="navbar sub-nav navbar-expand-lg">
        <!-- Wrap in container to center navbar-->
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>

                    <!-- Display only if admin-->
                    @can('is-admin')
                    <li class="nav-item">
                        <!-- User section where admin can manage users-->
                        <a class="nav-link" href="{{route('admin.users.index')}}">Users</a>
                    </li>
                    @endcan

                </ul>
            </div>
        </div>
    </nav>
    @endcan


    <!-- Base template from which views will extend from
         Wrap in container to center body -->
    <main class="container">
        <!-- Include at the top of every view that inherits from main
             Checks if status has been set in session and display if so -->
        @include('partials.alerts')
        <!-- Yield multiple sections-->
        @yield('content')
        <!-- Yield content of blade files-->
    </main>

</body>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.title', 'Auth App') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth
                    @if(Auth::user()->isSuperadmin())
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                        {{ config('app.superadmin_name', 'SuperAdmin') }}
                    </a>
                    @elseif(Auth::user()->isAdmin())
                    <a class="navbar-brand" href="{{ url('/admindashboard') }}">
                        {{ config('app.admin_name', 'Admin') }}
                    </a>
                    @elseif(Auth::user()->isUser())
                    <a class="navbar-brand" href="{{ url('/userdashboard') }}">
                        {{ config('app.user_name', 'User') }}
                    </a>
                    @endif
                    @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    @auth
                        @if (Auth::user()->isSuperadmin())
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.create') }}">Add User</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('admins.create') }}">Add Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.index1') }}">View Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('admins.index') }}">View Admins</a>
                            </li>
                        @elseif (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.adminCreate') }}">Add User</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.adminIndex') }}">View Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('admins.createAdmin') }}">Add Admins</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.adminViewIndex') }}">View Admins</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.superAdminViewIndex') }}">View SuperAdmins</a>
                            </li>
                        @elseif (Auth::user()->isUser())
                            <li class="nav-item">
                                <a class="btn btn-primary m-1" href="{{ route('users.showDetails') }}">Profile</a>
                            </li>
                        @endif
                    @endauth
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

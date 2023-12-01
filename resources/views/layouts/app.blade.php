<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.index') }}">{{ __('Home') }}</a>
                            </li>

                            @can('isAdmin', 'App/Models/User')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('dashboard.user.index') ? 'active' : '' }}"
                                        href="{{ route('dashboard.user.index') }}">{{ __('Gerenciamento de Usuários') }}</a>
                                </li>
                            @endcan
                        @endauth
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ request()->routeIs('dashboard.profile.show') ? 'active' : '' }}"
                                        href="{{ route('dashboard.profile.show') }}">
                                        {{ __('Meu Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('login.delete') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('login.delete') }}" method="POST"
                                        class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">

            @yield('content')

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div id="success-alert" class="alert alert-success alert-dismissible mt-4 mr-3"
                                role="alert">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>

                            <script>
                                setTimeout(function() {
                                    var successAlert = document.getElementById('success-alert');
                                    if (successAlert) {
                                        successAlert.remove();
                                    }
                                }, 10000);
                            </script>
                        @endif
                        @if (session('success-delete'))
                            <div id="success-delete-alert" class="alert alert-danger alert-dismissible mt-4 mr-3"
                                role="alert">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0">{{ session('success-delete') }}</p>
                                    </div>
                                </div>
                            </div>

                            <script>
                                setTimeout(function() {
                                    var successAlert = document.getElementById('success-delete-alert');
                                    if (successAlert) {
                                        successAlert.remove();
                                    }
                                }, 10000);
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

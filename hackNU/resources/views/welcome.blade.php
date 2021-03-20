<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UiHelp</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
{{--        @if (Route::has('login'))--}}
{{--            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--                @guest--}}
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
{{--                    @endif--}}
{{--                @else--}}

{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }}--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                <a href="{{ url('/home') }}" class="dropdown-item">Profile</a>--}}
{{--                                <a class="dropdown-item" href="{{ route('addPost') }}">--}}
{{--                                    Share problem--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}
{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                @endguest--}}
{{--            </div>--}}
{{--        @endif--}}

        <div id="app">
            <v-header></v-header>
            <router-view></router-view>
        </div>

    </body>
</html>

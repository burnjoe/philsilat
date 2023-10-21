<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PhilSilat') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layouts.navigation')

        @auth
        <div class="wrapper">
            @include('layouts.sidebar')

            <main class="main-content" id="main">
                {{ $slot }}
            </main>
        </div>
        @endauth

        @guest
        <div class="container-fluid">
            {{ $slot }}
        </div>
        @endguest
    </div>
</body>

</html>
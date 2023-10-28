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

    @livewireStyles
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

    @livewireScripts

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <script>
        let btn1 = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function () {
        sidebar.classList.toggle('active');
        }

        $(document).ready(function ($) {
        // function for toggling active class
        let alterClass = function () {
            var width = document.body.clientWidth;
            if (width < 768) {
            $('.sidebar').removeClass('active').addClass('mobile').addClass('mobile-offcanvas');
            } else if (width >= 768 && width < 992) {
            $('.sidebar').removeClass('mobile').removeClass('active');
            } else if (width >= 992) {
            $('.sidebar').removeClass('mobile').addClass('active');
            };
        };

        // execute it when the page is resized
        $(window).resize(function () {
            alterClass();
        });

        // execute it when the page first loads:
        alterClass();
        });
    </script>
</body>

</html>
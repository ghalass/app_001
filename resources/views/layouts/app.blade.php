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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css">

    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="app">

        @include('layouts.nav')
        <main class="container-fluid py-2">
            @include('common.alert')
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>


    {{-- Toastr Script for Livewire --}}
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        };
        window.addEventListener('success', event => {
            toastr.success(event.detail[0].message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail[0].message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail[0].message);
        });
        window.addEventListener('info', event => {
            toastr.info(event.detail[0].message);
        });
    </script>


    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if (Session::has('warning'))
        <script>
            toastr.warning("{{ session('warning') }}");
        </script>
    @endif

    @if (Session::has('info'))
        <script>
            toastr.info("{{ session('info') }}");
        </script>
    @endif

    {{-- Connect component file js --}}
    @stack('scripts')

    @livewireScripts
</body>

</html>

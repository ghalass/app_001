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
            {{-- @include('common.alert') --}}

            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light border-end">
                        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white ">
                            <a href="/"
                                class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="fs-5 d-none d-sm-inline">Menu</span>
                            </a>
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                id="menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link align-middle px-0 ">
                                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                        <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">
                                            Configs
                                            <i class="bi bi-caret-left me-3"></i>
                                        </span>
                                    </a>
                                    {{-- <ul class="collapse show nav flex-column ms-1" id="submenu1"
                                        data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="{{ route('sites.index') }}" wire:navigate wire:
                                                class="nav-link px-0">
                                                <span class="d-none d-sm-inline">Sites</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('typeparcs.index') }}" wire:navigate wire:
                                                class="nav-link px-0">
                                                <span class="d-none d-sm-inline">type parcs</span>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    <x-configs-header page="sites" />
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi-table"></i> <span
                                            class="ms-1 d-none d-sm-inline">Orders</span></a>
                                </li>

                                <li>
                                    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi-grid"></i> <span
                                            class="ms-1 d-none d-sm-inline">Products</span> </a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                        <li class="w-100">
                                            <a href="#" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline">Product</span>
                                                1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline">Product</span>
                                                2</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline">Product</span>
                                                3</a>
                                        </li>
                                        <li>
                                            <a href="#" class="nav-link px-0"> <span
                                                    class="d-none d-sm-inline">Product</span>
                                                4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi-people"></i> <span
                                            class="ms-1 d-none d-sm-inline">Customers</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col py-3">


                        {{-- CONTENT --}}

                        @yield('content')


                    </div>
                </div>
            </div>


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

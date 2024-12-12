<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Dashboard 2</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css">



    @stack('styles')
    @livewireStyles
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed  text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light navbar-collapse-hide-child">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a wire:navigate href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a wire:navigate href="{{ url('/configs') }}" class="nav-link">Configs</a>
                </li>
            </ul>
        </nav>

        @include('layouts.sibebar')


        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        @yield('header')

                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </section>
        </div>


        @include('layouts.footer')


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('js/buttons.dataTables.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>

    <script>
        // bootsrap Custom File Input initialization
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

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

    <script>
        // toastr notification initialization
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    {{-- Connect component file js --}}
    @stack('scripts')

    @livewireScripts

</body>

</html>

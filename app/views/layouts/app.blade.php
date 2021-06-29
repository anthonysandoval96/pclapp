<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ APP_NAME }} - @yield('title')</title>
    @include('layouts.includes.env')
    @yield('css')
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-grid.rtl.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-utilities.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-utilities.rtl.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}bootstrap/css/bootstrap-reboot.rtl.min.css"> --}}
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}custom/css/all-fonts.css">
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}custom/css/global.css">
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}custom/css/custom.css">
</head>

<body>
    <div id="app">
        @include('layouts.includes.header')
        @yield('content')
        @include('layouts.includes.footer')
    </div>
    <div class="spanner transaction text-white">
        <div class="spanner-content text-teal">
            <h3 class="mb-4">
                <div>Cargando ...</div>
                <div>espere un momento</div>
            </h3>
            <div class="spinner-border" style="width: 3rem; height: 3rem;"></div>
        </div>
    </div>
    <div class="spanner ajaxdata text-white">
        <div class="spanner-content text-white">
            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"></div>
        </div>
    </div>
    <script src="{{ PLUGINS_ROUTE }}jquery/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}
    <script src="{{ PLUGINS_ROUTE }}bootstrap/js/bootstrap.min.js"></script>
    {{-- <script src="{{ PLUGINS_ROUTE }}bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ PUBLIC_ROUTE }}custom/js/global.js?v=10.2.3"></script>
    <script src="{{ PLUGINS_ROUTE }}sweetalert2/sweetalert2.all.min.js"></script>
    @yield('script')
</body>

</html>
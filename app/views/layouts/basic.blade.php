<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ APP_NAME }} - @yield('title')</title>
    @include('layouts.includes.env')
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}dist/css/adminlte.min.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ PUBLIC_ROUTE }}plugins/fontawesome-free/css/all.min.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/all-fonts.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/global.css?{{CACHE_VERSION}}">
    <link rel="stylesheet" href="{{ CUSTOM_ROUTE }}css/custom.css?{{CACHE_VERSION}}">
    @yield('csss')
</head>
<body class="hold-transition text-sm" style="background-color: #e9ecef;">
    <div class="container">
        @yield('content')
        <div class="spanner transaction text-white">
            <div class="spanner-content text-teal">
                <h3 class="mb-4">
                    <div>Cargando ...</div>
                    <div>espere un momento</div>
                </h3>
                <div class="spinner-border" style="width: 3rem; height: 3rem;"></div>
            </div>
        </div>
    </div>
    <script src="{{ PUBLIC_ROUTE }}plugins/jquery/jquery.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{ PUBLIC_ROUTE }}dist/js/adminlte.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{ CUSTOM_ROUTE }}js/global.js?{{CACHE_VERSION}}"></script>
    <script src="{{ PLUGINS_ROUTE }}sweetalert2/sweetalert2.all.min.js?{{CACHE_VERSION}}"></script>
    @yield('scripts')
</body>
</html>
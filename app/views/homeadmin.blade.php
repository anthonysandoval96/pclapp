@extends('layouts.app')

@section('title', $titulo)

@section('content')
<!-- Main content -->
@php
    $primer_nombre = explode(" ", $userlogued["nombres"])[0];
@endphp

<div class="content">
    <div class="container">
        <div class="row pt-4">
            <div class="col-12 text-center">
                <h4>!Hola {{$primer_nombre}}!</h4>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-12 col-md-4 text-center mb-3">
                <a href="{{BASE_URL}}usuario/manage" class="btn border-success">
                    <i class="fas fa-users-cog mr-2"></i>Administrar Usuarios
                </a>
            </div>
            <div class="col-12 col-md-4 text-center mb-3">
                <a href="{{BASE_URL}}palabra" class="btn border-success">
                    <i class="far fa-file-alt mr-2"></i>Administrar Palabras
                </a>
            </div>
            <div class="col-12 col-md-4 text-center mb-3">
                <a href="{{BASE_URL}}usuario/precios" class="btn border-success">
                    <i class="fas fa-money-bill-alt mr-2"></i>Administrar Precios
                </a>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('script')
    <script src="{{ CUSTOM_ROUTE }}js/home.js?{{CACHE_VERSION}}"></script>
@endsection
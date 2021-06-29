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
            <div class="col-12 text-center">
                <button id="btn-empezar" class="btn btn-success2">
                    <i class="fas fa-running mr-1"></i>Empezar
                </button>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
        <div id="body-sesiones" class="row py-3" style="display: none;"></div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('script')
    <script src="{{ CUSTOM_ROUTE }}js/home.js"></script>
@endsection
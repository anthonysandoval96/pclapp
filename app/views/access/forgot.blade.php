@php $paises = listarPaises(); @endphp

@extends('layouts.basic')

@section('title', $titulo)

@section('content')
<div class="row p-4">
    <div class="login-logo col-12 col-md-4 m-auto">
        <img class="w-50 pr-2" src="{{ CUSTOM_ROUTE }}img/default/logo.png?{{CACHE_VERSION}}" alt="">
    </div>
    <!-- /.login-logo -->
</div>

<div class="row pt-3 justify-content-md-center">
    <div class="col-md-5">

        <div class="card">
            <div class="card-header">
                <div class="h5">{{$title}}</div>
            </div>
            <form id="form-forgot" name="form-forgot">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 py-3 text-center text-info">
                            <b>Las instrucciones de recuperación de contraseña se enviarán al correo electrónico especificado en el registro.</b>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <label for="in-usuario-username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="in-usuario-username" name="in-usuario-username" maxlength="50" placeholder="Ingrese username">
                                <span id="error-usuario-username" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <label for="in-usuario-email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="in-usuario-email" name="in-usuario-email" maxlength="45" placeholder="Ingrese email válido">
                                <span id="error-usuario-email" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group position-relative">
                                <button id="btn-action" class="btn btn-success2 w-100" type="submit">
                                    <i class="fas fa-sync-alt mr-1"></i>
                                    Enviar a correo
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group position-relative">
                                <a href="{{ BASE_URL }}login">Volver a la página principal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ CUSTOM_ROUTE }}js/{{$controller}}/forgot.js?{{CACHE_VERSION}}"></script>
@endsection
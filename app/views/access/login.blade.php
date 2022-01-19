@extends('layouts.basic')

@section('title', $title)

@section('content')
<div class="login-page" style="height: 85vh !important;">
    <div class="login-box m-auto">
        <div class="login-logo">
            <img class="w-50 pr-2" src="{{ CUSTOM_ROUTE }}img/default/logo.png" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg h5">Inicia sesión para comenzar</p>
                <form id="form-usuario-login" class="mb-3" autocomplete="off">
                    <div class="input-group mb-3">
                        <input name="in-usuario-email" id="in-usuario-email" type="text" class="form-control"
                            placeholder="username o email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="in-usuario-password" id="in-usuario-password" type="password" class="form-control"
                            placeholder="contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button id="btn-submit-login" type="submit" class="btn btn-success2 btn-sm btn-block"><i
                                    class="fas fa-sign-in-alt mr-2"></i>Ingresar</button>
                        </div>
                    </div>
                </form>
                <div id="eventos-campos-login" class="row text-center text-danger"></div>
                <div class="text-center">
                    <a href="{{ BASE_URL }}login/forgot">Olvidé mi contraseña</a>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ BASE_URL }}register" class="d-inline-block h1 border rounded border-info px-3 py-1">
                        <h5 class="mb-0">!Suscríbete ya!</h5>
                    </a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ CUSTOM_ROUTE }}js/access/login.js?{{CACHE_VERSION}}"></script>
@endsection
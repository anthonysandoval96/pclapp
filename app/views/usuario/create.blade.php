@extends('layouts.basic')

@section('title', $titulo)

@section('content')
<div class="row p-4">
    <div class="login-logo col-12 col-md-4 m-auto">
        <img class="w-50 pr-2" src="{{ CUSTOM_ROUTE }}img/default/logo.png" alt="">
    </div>
    <!-- /.login-logo -->
</div>

<div class="row pt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="float-left-0 float-md-left mb-0" style="color: #666;">Registro de usuario</h5>
            </div>
            <div class="card-body login-card-body">
                <form id="form-register" name="form-register">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-nombres" class="control-label">Nombres</label>
                                <input type="text" class="form-control" id="in-reniec-nombres" name="in-usuario-nombres" maxlength="50" placeholder="Ingrese solo nombres">
                                <span id="error-reniec-nombres" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-appaterno" class="control-label">Ap. Paterno</label>
                                <input type="text" class="form-control" id="in-reniec-appaterno" name="in-usuario-appaterno" maxlength="40" placeholder="Ingrese apellido paterno">
                                <span id="error-reniec-appaterno" class="fields-errors" ></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-apmaterno" class="control-label">Ap. Materno</label>
                                <input type="text" class="form-control" id="in-reniec-apmaterno" name="in-usuario-apmaterno" maxlength="40" placeholder="Ingrese apellido materno">
                                <span id="error-reniec-apmaterno" class="fields-errors"></span>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="sel-reniec-genero" class="control-label">Género</label>
                                <select id="sel-reniec-genero" name="sel-usuario-genero" class="form-control">
                                    <option value="">Seleccionar</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                </select>
                                <span id="error-reniec-genero" class="fields-errors"></span>
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-reniec-fnacimiento" class="control-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control center-text" id="in-reniec-fnacimiento" name="in-usuario-fnacimiento" maxlength="45">
                                <span id="error-reniec-fnacimiento" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-usuario-celular" class="control-label">Celular</label>
                                <input type="number" step="1" class="form-control" id="in-usuario-celular" name="in-usuario-celular" placeholder="Ejem. 960794123">
                                <span id="error-usuario-celular" class="fields-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group position-relative">
                                <label for="in-usuario-email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="in-usuario-email" name="in-usuario-email" maxlength="45" placeholder="Ingrese email válido">
                                <span id="error-usuario-email" class="fields-errors"></span>
                            </div>
                        </div>
                        {{-- <div class="col-md-7">
                            <div class="form-group position-relative">
                                <label for="in-usuario-direccion" class="control-label">Dirección</label>
                                <input type="text" class="form-control" id="in-usuario-direccion" name="in-usuario-direccion" maxlength="100" placeholder="Ingrese dirección actual">
                                <span id="error-usuario-direccion" class="fields-errors"></span>
                            </div>
                        </div> --}}
                        <div class="col-md-6"></div>
                        <div class="col-6 col-md-3">
                            <a href="{{BASE_URL}}login" class="btn btn-secondary w-100"><i class="far fa-arrow-alt-circle-left mr-2"></i>Atrás</a>
                        </div>
                        <div class="col-6 col-md-3">
                            <button id="btn-register" type="submit" class="btn btn-primary w-100"><i class="far fa-check-circle mr-2"></i>Registrarme</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ CUSTOM_ROUTE }}js/{{$name_route}}/create.js?{{CACHE_VERSION}}"></script>
@endsection
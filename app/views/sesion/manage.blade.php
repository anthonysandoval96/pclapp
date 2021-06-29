@extends('layouts.app')

@section('title', $titulo)

@php
    if (isset($_SESSION["sesion_diaria"])) {
        $sesion_diaria = $_SESSION["sesion_diaria"];
    } else {
        $sesion_diaria = [];
    }

    $numero_de_veces = numerodeveces($userlogued["fecha_nacimiento"]);
    $texto_veces = "veces";
    if ($numero_de_veces == "01") $texto_veces = "vez";
    
    $html_instrucciones = "<h3 class='text-center'>Sesión Nº ".$sesion_diaria['sesion']."</h3>";
    $html_instrucciones .= "<p>Click en la palabra desconocida que elija.</p>";
    $html_instrucciones .= "<p>En todo caso, la menos conocida ...</p>";
    $html_instrucciones .= "<p>Si conoce todas muy bien; pida <span class='font-weight-bold'>'Nuevas palabras'</span>.</p>";
    $html_instrucciones .= "<p>Lea en voz alta <span id='num_de_veces' class='h4 text-danger'>".$numero_de_veces."</span> <span id='texto_veces'>".$texto_veces."</span> el texto que aparece de la palabra nueva.</p>";
    $html_instrucciones .= "<p>A continuación, marque cada palabra que conoce de éste listado.</p>";
    $html_instrucciones .= "<p>Presione <span class='font-weight-bold'>'Continuar'</span></p>";

@endphp

@section('content')
<!-- Main content -->
<div class="content px-2">
    <div id="body-palabras" class="container">
        <div class="row">
            <div class="col-12 d-none d-md-block col-md-5 mt-3">
                <div class="card">
                    <div class="card-body">
                        {!!$html_instrucciones!!}
                    </div>
                </div>
            </div>
            <div class="col-12 d-block d-md-none col-md-5 mt-3">
                <div class="card">
                    <div class="card-header">
                        <a class="text-info" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-decoration: none;">
                            <i class="fa fa-chevron-down float-right"></i>
                            <span class="d-block">Leer instrucciones</span>
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse">
                        <div class="card-body">
                            {!!$html_instrucciones!!}
                        </div>
                    </div>
                    
                </div>
            </div>
            <form class="col-12 col-md-7" id="form-sesiones" name="form-sesiones">
                <div class="text-center my-2"><div class="spinner-border {{$controller}} text-info"></div></div>
                <div id="body-palabras-sesion" style="display: none;"></div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="significado" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div id="text-significado" class="col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6"></div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-primary w-100" data-dismiss="modal">Listo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-instruccion" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="border-bottom p-2 text-center">
                    <h5 class="modal-title text-primary"></h5>
                  </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="text-instruccion" class="col-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <i class="far fa-check-circle mr-1"></i>Entendido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content -->
@endsection

@section('script')
    <script src="{{ CUSTOM_ROUTE }}js/{{$controller}}/manage.js"></script>
@endsection
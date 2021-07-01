@extends('layouts.app')

@section('title', $titulo)

@section('content')
    <section class="content pt-3">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-md-6 m-auto text-center">
                    <a href="{{BASE_URL}}home" class="btn btn-info">
                        <i class="far fa-arrow-alt-circle-left mr-1"></i>Regresar al menú principal
                    </a>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-12 text-center">
                    <h3>Palabras Aprendidas</h3>
                </div>
            </div>
            <div class="row pt-2 pb-5">
                @foreach ($palabras_aprendidas as $word)
                    <div class="col-6 col-md-3 border">{{$word["nombre"]}}</div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ CUSTOM_ROUTE }}js/{{$controller}}/perfil.js?{{CACHE_VERSION}}"></script>
@endsection
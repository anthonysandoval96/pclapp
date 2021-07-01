@extends('layouts.app')

@section('title', $title)

@section('css')
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ PLUGINS_ROUTE }}datatables/buttons.dataTables.min.css">
@endsection

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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center px-3 py-2">
                        <h3 class="h5 mt-1 float-none float-md-left">{{$title}}</h3>
                        {{-- <div class="float-md-right mb-md-0 mb-1">
                            <button id="btn-add-{{$controller}}" class="btn btn-success2 btn-sm w-100" data-modal="modal-{{$controller}}">
                                <i class="fa fa-plus mr-1"></i>Crear {{ucwords($controller)}}
                            </button>
                        </div> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body px-3 pt-3 pb-2">
                        <div class="table-responsive" style="overflow-x: initial;">
                            <div class="text-center"><div class="spinner-border {{$controller}} text-secondary"></div></div>
                            <table id="table-{{getPluralPrase($controller)}}" class="table table-bordered table-hover table-custom d-none">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Ap. Paterno</th>
                                        <th>Ap. Materno</th>
                                        <th>Rol</th>
                                        <th>Username</th>
                                        <th>F. Creación</th>
                                        <th>Estado</th>
                                        {{-- <th>Acciones</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@include($controller.'/actions')
@endsection

@section('script')
    <script src="{{PLUGINS_ROUTE}}datatables/jquery.dataTables.min.js?{{CACHE_VERSION}}"></script>
    {{-- <script src="{{PLUGINS_ROUTE}}datatables-responsive/js/dataTables.responsive.min.js?{{CACHE_VERSION}}"></script> --}}
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/dataTables.buttons.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.flash.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.colVis.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/jszip.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/pdfmake.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/vfs_fonts.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.html5.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.print.min.js?{{CACHE_VERSION}}"></script>
    <script src="{{ CUSTOM_ROUTE }}js/{{$controller}}/manage.js?{{CACHE_VERSION}}"></script>
@endsection
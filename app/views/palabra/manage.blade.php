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
        <div class="row pb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center px-3 py-2">
                        <h3 class="h5 mt-1 float-none float-md-left mb-3 mb-md-0">{{$title}}</h3>
                        <div class="float-md-right mb-md-0 mb-1">
                            <button id="btn-import-{{$controller}}" data-modal="modal-import-{{$controller}}" class="btn btn-success2 w-100">
                                <i class="fa fa-plus mr-1"></i>Importar {{ucwords(getPluralPrase($controller))}}
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body px-3 pt-3 pb-2">
                        <div class="table-responsive" style="overflow-x: initial;">
                            <div class="text-center"><div class="spinner-border {{$controller}} text-secondary"></div></div>
                            <table id="table-{{getPluralPrase($controller)}}" class="table table-bordered table-hover table-custom d-none">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Palabra</th>
                                        <th>Significado</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12">
                @include($controller.'/actions')
            </div>
        </div>
        
    </div>
</section>
@endsection

@section('script')
    <script src="{{PLUGINS_ROUTE}}datatables/jquery.dataTables.min.js"></script>
    {{-- <script src="{{PLUGINS_ROUTE}}datatables-responsive/js/dataTables.responsive.min.js"></script> --}}
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.flash.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/jszip.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/pdfmake.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/vfs_fonts.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{PLUGINS_ROUTE}}datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ CUSTOM_ROUTE }}js/{{$controller}}/manage.js?v=10.5.4"></script>
@endsection
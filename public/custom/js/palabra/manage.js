var control1 = "palabra";
var table = $('#table-'+getPluralPrase(control1));
var tbody = $('#tbody-import-'+getPluralPrase(control1));

$(document).ready(function() {
    cargarRegistros();

    $("#modal-import-palabra").on("hidden.bs.modal", function () {
        $("#info").text("Ningún archivo seleccionado.");
        $("#file-upload").val("");
        $("#row-ajaxdata-main").fadeOut();
        $("#cantidad-de-palabras").text("");
        $(tbody).html("");
    });

    $(document).on('click', '#btn-import-'+control1, function() {
        process_modal($(this), 'importar');
    }).on('submit', '#form-'+control1, function (e) {
        e.preventDefault();
        cuPalabra(this, $(this).attr('data-op'));
    }).on('click', '#btn-postimport-'+control1, function () {
        $(this).closest("form").submit();
    }).on('submit', '#form-import-'+control1, function (e) {
        e.preventDefault();
        if ($("#file-upload").val() !== "") {
            migration_excel_bd(this);
        } else {
            alerts("alert-error", "No existe ningún archivo seleccionado.");
        }
    }).on('change', '#file-upload', function () {

        var fileimport = $(this);
        var fileimportVal = fileimport.val();
        var ext = fileimportVal.split(".").pop();
        var formimport = $(this).closest("form");

        if (ext == "xls" || ext == "xlsx" || ext == "csv") {
            procesar_excel(formimport[0]);
        } else {
            $("#info").text("Ningún archivo seleccionado.");
            fileimport.val("");
            alerts("alert-error", "La extensión <b>'"+ext+"'</b> no está permitida.");    
        }
    }).on('click', ".ul-acciones-opciones .item-click", function (e) {
        e.preventDefault(); var data = "";
        if ($(this).parents("tr").hasClass("child")) {
            data = table.DataTable().row($(this).parents("tr").prev()).data();
        } else { data = table.DataTable().row($(this).parents("tr")).data(); }
        if ($(this).attr('id') === "link-accion-cambiarestado") { 
            cambiarEstado(data.usuario_id, data.estado); 
        } else if ($(this).attr('id') === "link-accion-editar") {
            process_modal($(this), "editar");
            $("#in-palabra-nombre").val(data.nombre);
            $("#in-palabra-significado").val(data.significado);
            $("#hdn-palabra-id").val(btoa(data.id));
        } else if ($(this).attr('id') === "link-accion-eliminar") {
            eliminarPalabra(data.id);
        }
    });
});

function cargarRegistros() {
    table.dataTable().fnDestroy();
    loadDataTable();
}

function procesar_excel(form) {
    $.ajax({
        url: PROJECT_NAME + "/palabra/preview",
        method: 'POST',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".spinner-border.import."+control1).addClass("my-4").show();
        },
        success: function(data) {
            var json = JSON.parse(data);
            $("#cantidad-de-palabras").html(json.cantidad);
            $(tbody).html(json.html);
        },
        complete: function () {
            $(".spinner-border.import."+control1).removeClass("my-4").hide();
            $("#row-ajaxdata-main").fadeIn(1500);
        }
    });
}

function migration_excel_bd(form) {
    var modal = $(form).closest(".modal.fade");
    $.ajax({
        url: PROJECT_NAME + "/palabra/migration",
        method: 'POST',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            loadingOverLay("show");
        },
        success: function(data) {
            var json = JSON.parse(data);
            $(modal).modal('hide');
            if (json.respuesta) {
                cargarRegistros();
                alerts('alert-success', json.mensaje);
            } else { alerts('alert-error', json.mensaje); }
        },
        complete: function () {
            loadingOverLay("hide");
        }
    });
}

function cuPalabra(form, op) {
    var data = $(form).serialize();
    var modal = $(form).closest(".modal.fade");
    var url = "";
    if (op === "registrar") { url = PROJECT_NAME + "/palabra/registrar";
    } else if (op === "editar") { url = PROJECT_NAME + "/palabra/update";
    } else { return false; }
    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function(data) {
            // console.log(data);
            // return false;
            var json = JSON.parse(data);
            $(modal).modal('hide');
            if (json.respuesta) {
                cargarRegistros();
                alerts('alert-success', json.mensaje);
            } else { alerts('alert-error', json.mensaje); }
        }
    });
}

function eliminarPalabra(id) {
    console.log(id);
    Swal.fire({
        title: 'Confirmación!',
        html: "¿Estás seguro que deseas <b>eliminar</b> esta palabra?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if(result.value) {
            $.ajax({
                url: PROJECT_NAME + "/palabra/delete/"+id,
                method: 'POST',
                data: "",
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.respuesta) {
                        cargarRegistros();
                        alerts('alert-success', json.mensaje);
                    } else { alerts('alert-error', json.mensaje); }
                }
            });
        }
    });
}

function loadDataTable() {
    table.DataTable({
        ajax: {
            url: PROJECT_NAME+"/"+control1+"/getRegistros",
            dataSrc: function (json) {
                $(".spinner-border."+control1).hide();
                table.removeClass("d-none");
                return json.data;
            }
        },
        columns: [
            { data: "id", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "nombre", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "significado", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "estado", className: "text-center wh-sp",
                render: function (data) {
                    var estado = ""; var style = "";
                    if (data === "1") { estado = "Activo"; style = "text-success";
                    } else { estado = "Inactivo"; style = "text-secondary"; }
                    return "<span class='" + style + " font-weight-bold text-uppercase px-3 py-1 rounded'>" + estado + "</span>";
                }
            },
            { data: "estado", className: "text-center wh-sp", render: function(data) { return cargarAcciones(data); } }
        ],
        autoWidth: false,
        language: {
            "lengthMenu": "Mostrar _MENU_ filas",
            "zeroRecords": "No hay registros disponibles.",
            "info": "_START_ - _END_ de _TOTAL_ resultados",
            "infoEmpty": "No se encontró ningún resultado.",
            "infoFiltered": "",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search":         "Buscar:",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        dom: 'lBfrtip',
        buttons: [
            { 
                extend: 'copy',
                text: "<i class='far fa-copy'></i>",
                titleAttr: 'Copiar tabla',
                exportOptions: {columns: [0,1,2,3]}
            },
            {
                extend: 'excel', 
                text: "<i class='far fa-file-excel'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Exportar a EXCEL',
                exportOptions: {columns: [0,1,2,3]}
            },
            {
                extend: 'pdf', 
                text: "<i class='far fa-file-pdf'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Exportar a PDF',
                exportOptions: {columns: [0,1,2,3]}
            },
            {
                extend: 'print',
                text: "<i class='fas fa-print'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Imprimir',
                exportOptions: {columns: [0,1,2,3]}
            }
        ]
    });
}


function cargarAcciones(estado) {
    var title = "Activar";
    if (estado === "1") { title = "Inactivar"; }
    var acciones = `
        <div class='d-flex align-items-center justify-content-center ul-acciones-opciones'>
            <button id='link-accion-editar' class='btn btn-sm btn-info mr-2 item-click' title='Editar' data-modal="modal-palabra">
                <i class='far fa-edit d-inline-block'></i>
            </button>
            <button id='link-accion-eliminar' class='btn btn-sm btn-danger item-click' title='Eliminar' data-modal="modal-palabra">
                <i class='far fa-trash-alt d-inline-block'></i>
            </button>
        </div>
    `;
    return acciones;
}

/*
<button id='link-accion-cambiarestado' class='btn btn-sm btn-orange mr-2 item-click' title='`+title+`' data-modal="modal-palabra">
    <i class='fas fa-sync-alt d-inline-block'></i>
</button>
*/
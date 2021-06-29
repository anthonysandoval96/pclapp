var control1 = "usuario";
var table = $('#table-'+getPluralPrase(control1));

$(document).ready(function() {
    cargarRegistros();
});

function cargarRegistros() {
    table.dataTable().fnDestroy();
    loadDataTable();
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
            { data: "usuario_id", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "nombres", className: "text-center white-space" },
            { data: "apellido_paterno", className: "text-center white-space" },
            { data: "apellido_materno", className: "text-center white-space" },
            { data: "nombre", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "username", className: "text-center wh-sp",
                render: function(data) { if (data === "") { return "<span class='text-muted'>No disponible</span>"; } else { return data; } } 
            },
            { data: "created", className: "text-center wh-sp",
                render: function(data) { 
                    if (data === "") { 
                        return "<span class='text-muted'>No disponible</span>"; 
                    } else { 
                        var fecha = data.split("-");
                        var fecha_sort = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
                        return fecha_sort; 
                    } 
                } 
            },
            { data: "estado", className: "text-center wh-sp",
                render: function (data) {
                    var estado = ""; var style = "";
                    if (data === "1") { estado = "Activo"; style = "text-success";
                    } else { estado = "Inactivo"; style = "text-secondary"; }
                    return "<span class='" + style + " font-weight-bold text-uppercase px-3 py-1 rounded'>" + estado + "</span>";
                }
            }
            // ,{ data: "estado", className: "text-center wh-sp", render: function(data) { return cargarAcciones(data); } }
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
                exportOptions: {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend: 'excel', 
                text: "<i class='far fa-file-excel'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Exportar a EXCEL',
                exportOptions: {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend: 'pdf', 
                text: "<i class='far fa-file-pdf'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Exportar a PDF',
                exportOptions: {columns: [0,1,2,3,4,5,6,7]}
            },
            {
                extend: 'print',
                text: "<i class='fas fa-print'></i>",
                title: "Reporte de "+getPluralPrase(control1, 'may'),
                titleAttr: 'Imprimir',
                exportOptions: {columns: [0,1,2,3,4,5,6,7]}
            }
        ]
    });
}

function cargarAcciones(estado) {
    var title = "Activar";
    if (estado === "1") { title = "Inactivar"; }
    var acciones = `
        <div class='d-flex align-items-center justify-content-center ul-acciones-opciones'>
            <button id='link-accion-editar' class='btn btn-sm btn-info mr-2 item-click' title='Editar'>
                <i class='far fa-edit d-inline-block'></i>
            </button>
            <button id='link-accion-cambiarestado' class='btn btn-sm btn-orange mr-2 item-click' title='`+title+`'>
                <i class='fas fa-sync-alt d-inline-block'></i>
            </button>
            <button id='link-accion-eliminar' class='btn btn-sm btn-danger item-click' title='Eliminar'>
                <i class='far fa-trash-alt d-inline-block'></i>
            </button>
        </div>
    `;
    return acciones;
}
var body_palabras = $("#body-palabras-sesion");
var modal_significado = $("#significado");
var modal_instruccion = $("#modal-instruccion");
$(document).ready(function() {
    cargarRegistros();
    $(document).on('click', '.eachword', function(e) {
        if ($(this).prop('checked')) {
            if (atob($("#sesion-data").val()).split(",")[4] !== "0") {
                if ($(this).closest(".row").hasClass("bg-light text-info")) {
                    $(this).closest(".row").removeClass("bg-light text-info");
                } else {
                    $(this).closest(".row").addClass("bg-light text-info");
                }
            } else e.preventDefault();
    
            if (atob($("#sesion-data").val()).split(",")[4] == "2") {
                let idword = $(this).val();
                var dataString = $(this).closest("form").serialize();
                $.ajax({
                    url: PROJECT_NAME + "/sesion/seleccionarPalabrasConocidas",
                    method: 'POST',
                    data: dataString,
                    success: function (data) {
                        mostrarSignificadoDePalabra(idword);
                    }
                });
            }
        } else {
            if (atob($("#sesion-data").val()).split(",")[4] == "1") {
                if ($(this).closest(".row").hasClass("bg-light text-info")) {
                    $(this).closest(".row").removeClass("bg-light text-info");
                } else {
                    $(this).closest(".row").addClass("bg-light text-info");
                }
            } else e.preventDefault();
        }    
    }).on('submit', '#form-sesiones', function(e) {
        e.preventDefault();
        var dataString = $(this).serialize();
        $(body_palabras).fadeOut();
        $(".spinner-border.sesion").parent("div").show();
        $(".spinner-border.sesion").show();
        if (atob($("#sesion-data").val()).split(",")[4] == "0") {

            $sesion_data = atob($("#sesion-data").val());
            $.ajax({
                url: PROJECT_NAME + "/sesion/actualizarSesion",
                method: 'POST',
                data: dataString,
                success: function (data) {
                    cargarRegistros();
                }
            });

        } else {
            $.ajax({
                url: PROJECT_NAME + "/sesion/seleccionarPalabrasConocidas",
                method: 'POST',
                data: dataString,
                success: function (data) {
                    cargarRegistros();
                }
            });
        }
    });
});

function cargarRegistros() {
    $.ajax({
        url: PROJECT_NAME + "/sesion/obtenerDatosSesion",
        method: 'POST',
        data: '',
        success: function (data) {
            var json = JSON.parse(data);
            cargarPalabras(json);
        }
    });
}

function cargarPalabras(sesion) {
    $.ajax({
        url: PROJECT_NAME + "/sesion/cargarPalabrasDeSesion",
        method: 'POST',
        data: '',
        success: function (data) {
            var json = JSON.parse(data);

            let bodyhtml = htmlTablaPalabras(json, sesion);
            $(body_palabras).html(bodyhtml).fadeIn(1000);

            let html = "";
            if (atob($("#sesion-data").val()).split(",")[4] == "1") {
                html = `<p class="text-center">Seleccione todas palabras que conozca y luego hacer click en 
                            <span class='text-success font-weight-bold'>continuar</span>
                        </p>`;
            } else if (atob($("#sesion-data").val()).split(",")[4] == "2")  {
                html = `<p class="text-center">Seleccione una sola palabra para leer su significado en voz alta y luego hacer click en 
                            <span class='text-success font-weight-bold'>continuar</span>
                        </p>`;
            } else { return false; }
            
            $(modal_instruccion).find(".modal-title").html("Sesión Nº " + sesion.sesion + " - " + "Línea Nº " + sesion.linea);
            $(modal_instruccion).find('#text-instruccion').html(html);
            $(modal_instruccion).modal("show");

        },
        complete: function () {
            $(".spinner-border.sesion").hide();
            $(".spinner-border.sesion").parent("div").hide();
        }
    });
}

function htmlTablaPalabras(data, sesion) {
    var sesion_data = sesion.id+","+sesion.sesion+","+sesion.linea+","+sesion.letra+","+sesion.parte;

    var html = 
    `
    <div  class="row mt-2 font-weight-bold">
        <div class="col-6 text-center py-1">Sesión Nº `+sesion.sesion+`</div>
        <div class="col-6 text-center py-1">Línea: `+sesion.linea+` - `+sesion.letra+`</div>
    </div>
    <div  class="row font-weight-bold border-info" style="border-top: 2px solid; border-bottom: 2px solid;">
        <div class="col-6">
            <div class="row">
                <div class="col-2 py-1 text-center">Nº</div>
                <div class="col-10 py-1 text-center">Palabras</div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-2 py-1 text-center">Nº</div>
                <div class="col-10 py-1 text-center">Palabras</div>
            </div>
        </div>
    </div>
    <div class="row border-info" style="border-bottom: 2px solid;">
    `;    
    let cont = 1;
    jQuery.each(data, function(k,v) {
        let checked = "", color = "", disabled = "";
        
        if (sesion.parte !== "1") disabled = "readonly='readonly'";
        
        if (v.checked == 1)  {
            checked = "checked";
            color = "bg-light text-info";
        } else disabled = "";

        html += 
        `
        <div class="col-6">
            <label for="check-`+v.id+`" class="row border `+color+` mb-0 cursor-pointer">
                <div class="col-2 py-2 divcheck text-center">
                    `+cont+`
                    <input class="cursor-pointer eachword d-none" type="checkbox" id="check-`+v.id+`" name="check-word[]" value="`+v.id+`" `+checked+` `+disabled+`>
                </div>
                <div class="col-10 py-2">`+ucfirst(v.nombre)+`</div>
            </label>
        </div>
        `;
        cont = cont + 1;
    });
    html += "</div>";

    html += 
    `
    <div class="row my-3">
        <div class="col-6">
        <a href="`+PROJECT_NAME+`/home" class="btn btn-secondary w-100">
            <i class="far fa-arrow-alt-circle-left"></i> Regresar
        </a>
        </div>
        <div class="col-6 text-center">
            <button id="btn-continuar" class="btn btn-success2 w-100">
                <i class="far fa-arrow-alt-circle-right"></i> Continuar
            </button>
        </div>
    </div>
    <input id="sesion-data" name="sesion-data" type="hidden" value="`+btoa(sesion_data)+`">
    `;

    return html;
}

function mostrarSignificadoDePalabra(idword) {

    // var idsesion = atob($("#sesion-data").val()).split(",")[0];

    var numero_veces = $("#num_de_veces").text();
    var texto_veces = $("#texto_veces").text();

    $.ajax({
        url: PROJECT_NAME + "/sesion/cargarSignificadoDePalabra/"+idword,
        method: "POST",
        data: '',
        success: function (data) {
            var json = JSON.parse(data);
            $(modal_significado).find('#text-significado').html(
                `
                <p class="font-weight-bold">(Lea <span class="h4 text-danger">`+numero_veces+`</span> `+texto_veces+` en voz alta)</p>
                <p>
                    <span class="font-weight-bold">`+ucfirst(json.palabra)+`:</span> `+json.significado+`
                </p>
                `
            );
            $(modal_significado).modal("show");

            $.ajax({
                url: PROJECT_NAME + "/sesion/obtenerDatosSesion",
                method: 'POST',
                data: '',
                success: function (data) {
                    var sesion = JSON.parse(data);
                    var sesion_data = sesion.id+","+sesion.sesion+","+sesion.linea+","+sesion.letra+","+sesion.parte;
                    $("#sesion-data").val(btoa(sesion_data));
                }
            });
        }
    });
}
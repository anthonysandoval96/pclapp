var body_palabras = $("#body-palabras-sesion");
var body_instrucciones = $("#instrucciones");
var modal_significado = $("#significado");
var modal_instruccion = $("#modal-instruccion");
$(document).ready(function() {
    cargarRegistros();
    $(document).on('click', '.eachword', function(e) {

        if ($(this).prop('checked')) {  /*Si realizaste el checked*/
            
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
        
        var checkbox_length = $(this).find("input[type=checkbox]").length;
        var checkbox_selected_length = $(this).find("input[type=checkbox]:checked").length;

        if (checkbox_selected_length > 0) {
    
            var dataString = $(this).serialize();

            console.log(atob($("#sesion-data").val()).split(",")[4]);
            
            if (atob($("#sesion-data").val()).split(",")[4] == "0") {
                $(body_palabras).fadeOut();
                $(".spinner-border.sesion").parent("div").show();
                $(".spinner-border.sesion").show();

                $.ajax({
                    url: PROJECT_NAME + "/sesion/actualizarSesion",
                    method: 'POST',
                    data: dataString,
                    success: function (data) {
                        cargarRegistros();
                    }
                });
            } else if (atob($("#sesion-data").val()).split(",")[4] == "1") {
                $(body_palabras).fadeOut();
                $(".spinner-border.sesion").parent("div").show();
                $(".spinner-border.sesion").show();

                if (checkbox_selected_length == checkbox_length) {
                    console.log("entro");
                    $.ajax({
                        url: PROJECT_NAME + "/sesion/actualizarSesionAll",
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
            } else {
                /* Si en la 1era parte se seleccionaron las 20 palabras 
                   en la 2da parte se pasará directo a la parte final */
                if (checkbox_selected_length == checkbox_length) {
                    actualizarParteDeSesion(this, dataString);
                } else {
                    var html = generate_html_instruccion(3);
                    alerts("alert-warning", html, "Información importante");
                }
            }
        } else {
            /* Cambiar la letra y generar nuevas palabras 
               cuando no seleccionas ninguna palabra */
            if (checkbox_length > 0) {
                cambiarLetraYpalabras();
            } else {
                var html = generate_html_instruccion(4);
                alerts("alert-warning", html, "Información importante");
            }
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
            var resp = JSON.parse(data);

            if (sesion.control_diario == 0) {
                Swal.fire({
                    title: 'Información',
                    html: generate_html_instruccion(5),
                    type: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Entendido'
                }).then((result) => {
                    window.location.href = BASE_URL+"/home";
                })

            } else {

                var instrucciones = "<a href='' class='' data-toggle='modal' data-target='#instruc'>Instrucciones generales de uso</a>";
                $(body_instrucciones).html(instrucciones).fadeIn(900);
                let bodyhtml = htmlTablaPalabras(resp, sesion);
                $(body_palabras).html(bodyhtml).fadeIn(1000);

                if (sesion.respuesta) {
                    let html = "";
                    if (atob($("#sesion-data").val()).split(",")[4] == "1") {
                        html = generate_html_instruccion(1);
                    } else if (atob($("#sesion-data").val()).split(",")[4] == "2")  {
                        html = generate_html_instruccion(2);
                    } else { return false; }
                    
                    $(modal_instruccion).find(".modal-title").html("Sesión Nº " + sesion.sesion + " - " + "Línea Nº " + sesion.linea);
                    $(modal_instruccion).find('#text-instruccion').html(html);
                    $(modal_instruccion).modal("show");
                }
            }
        },
        complete: function () {
            $(".spinner-border.sesion").hide();
            $(".spinner-border.sesion").parent("div").hide();
        }
    });
}

function htmlTablaPalabras(data, sesion) {
    var sesion_data = sesion.id+","+sesion.sesion+","+sesion.linea+","+sesion.letra+","+sesion.parte+","+sesion.control_diario;

    var html = 
    `
    <div  class="row mt-2 font-weight-bold">
        <div class="col-6 text-center py-1">Sesión Nº `+sesion.sesion+`</div>
        <div class="col-6 text-center py-1">Línea: `+sesion.linea+` - `+getLetterLine(sesion.letra)+`</div>
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
    if (Object.keys(data).length === 0) {
        var msg = generate_html_instruccion(4);
        html += `<div class="col-12 text-center py-3">`+msg+`</div>`;
    } else {
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
    }
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

            asignarNuevaDataSesion();
        }
    });
}

function cambiarLetraYpalabras() {
    $.ajax({
        url: PROJECT_NAME + "/sesion/cambiarLetraYpalabras",
        method: 'POST',
        data: '',
        success: function (data) {
            var json = JSON.parse(data);
            // if (json.respuesta) cargarRegistros();
            let type = "warning";
            if (!json.respuesta) {
                Swal.fire({
                    title: 'Información importante',
                    html: json.mensaje,
                    type: type,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    cargarRegistros();
                })
            } else {
                cargarRegistros();
            }
        }
    });
}

function generate_html_instruccion(num_msg) {

    const mensaje = {
        1: "Seleccione todas las palabras que conozca y luego hacer click en <span class='text-success font-weight-bold'>continuar</span>", 
        2: "Seleccione una sola palabra para leer su significado en voz alta y luego hacer click en <span class='text-success font-weight-bold'>continuar</span>",
        3: "Necesitas hacer click en una palabra para leer su significado en voz alta!",
        4: "Ya no hay palabras que no conozcas!",
        5: "Acabaste la sesión completa, te esperamos mañana. <div class='text-center'>Muchas gracias &#128513 !!</div>"
    };

    var html = `<p class="text-center">`+mensaje[num_msg]+`</p>`;
    
    return html;
}

function asignarNuevaDataSesion(el, n = null) {
    $.ajax({
        url: PROJECT_NAME + "/sesion/obtenerDatosSesion",
        method: 'POST',
        data: '',
        success: function (data) {
            var sesion = JSON.parse(data);
            var sesion_data = sesion.id+","+sesion.sesion+","+sesion.linea+","+sesion.letra+","+sesion.parte;
            $("#sesion-data").val(btoa(sesion_data));
            if (n == "exep") $(el).submit();
        }
    });
}

function actualizarParteDeSesion(el, dataString) {
    $.ajax({
        url: PROJECT_NAME + "/sesion/actualizarParteDeSesion",
        method: 'POST',
        data: dataString,
        success: function (data) {
            asignarNuevaDataSesion(el, 'exep');
        }
    });
}
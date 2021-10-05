$(document).ready(function () {
    $("#form-register")[0].reset();
    $(document).on('submit', '#form-register', function(e) {
        e.preventDefault();
        $(this).find("button[type='button']").prop('disabled', true);
        var dataform = $(this).serialize();
        if (validarDatos()) {
            changeSubmitIcon($("#btn-register"), "fa-check-circle", "submit", "far");
            $.post(PROJECT_NAME + "/register/cap_sesion_user_register", dataform, function(data, status){
                window.location.href = BASE_URL + "register/realizarpago";
            });
        } else {
            changeSubmitIcon($("#btn-register"), "fa-check-circle", "error", 'far');
            $(this).find("button[type='button']").prop('disabled', false);
        }
    }).on('click', '#btn-ir-formulario', function(e) {
        e.preventDefault();
        $(".tab-dev").css("display", "none");
        $("#formulario").fadeIn(1000);
    }).on('click', '#btn-register', function(e) {
        e.preventDefault();
        $(this).closest("form").submit();
    }).on('click', '#btn-atras', function() {
        window.location.href = BASE_URL + "login";
    });
});

function validarDatos() {
    var form = document.getElementsByName("form-register")[0];
    var formElements = form.elements;
    /* limpiar los errores si hubiera */
    for (var i = 0; i < formElements.length; i++)
        activarQuitarEstadoError(formElements[i], 'quitar');
    /* elementos a validar */
    var inputNombres = document.getElementById("in-reniec-nombres");
    var inputApellidoPaterno = document.getElementById("in-reniec-appaterno");
    var inputApellidoMaterno = document.getElementById("in-reniec-apmaterno");
    // var selGenero = document.getElementById("sel-reniec-genero");
    var inputNacimiento = document.getElementById("in-reniec-fnacimiento");
    var inputEmail = document.getElementById("in-usuario-email");

    var selPais = document.getElementById("sel-usuario-pais");
    var inputNroDocumento = document.getElementById("in-usuario-dni");

    var errores = 0, textoError = "";
    /* validaciones */

    if (inputNombres.value.trim() === "") {
        textoError = "Ingrese nombres";
        activarQuitarEstadoError(inputNombres, 'activar', textoError);
        errores++;
        if (errores === 1) inputNombres.focus();
    } else {
        if (!validaNombres(inputNombres.value)) {
            textoError = "Nombres (sólo letras)";
            activarQuitarEstadoError(inputNombres, 'activar', textoError);
            errores++;
            if (errores === 1) inputNombres.focus();
        }
    }
    if (inputApellidoPaterno.value.trim() === "") {
        textoError = "Ingrese apellido paterno";
        activarQuitarEstadoError(inputApellidoPaterno, 'activar', textoError);
        errores++;
        if (errores === 1) inputApellidoPaterno.focus();
    } else {
        if (!validaNombres(inputApellidoPaterno.value)) {
            textoError = "Apellido Paterno (sólo letras)";
            activarQuitarEstadoError(inputApellidoPaterno, 'activar', textoError);
            errores++;
            if (errores === 1) inputApellidoPaterno.focus();
        }
    }
    if (inputApellidoMaterno.value.trim() === "") {
        textoError = "Ingrese apellido materno";
        activarQuitarEstadoError(inputApellidoMaterno, 'activar', textoError);
        errores++;
        if (errores === 1) inputApellidoMaterno.focus();
    } else {
        if (!validaNombres(inputApellidoMaterno.value)) {
            textoError = "Apellido Materno (sólo letras)";
            activarQuitarEstadoError(inputApellidoMaterno, 'activar', textoError);
            errores++;
            if (errores === 1) inputApellidoMaterno.focus();
        }
    }
    // if (selGenero.value === "") {
    //     textoError = "Seleccione género";
    //     activarQuitarEstadoError(selGenero, 'activar', textoError);
    //     errores++;
    //     if (errores === 1) selGenero.focus();
    // }
    if (inputNacimiento.value === "") {
        textoError = "Seleccione fecha de nacimiento";
        activarQuitarEstadoError(inputNacimiento, 'activar', textoError);
        errores++;
        if (errores === 1) inputNacimiento.focus();
    }

    if (selPais.value === "") {
        textoError = "Seleccione un país";
        activarQuitarEstadoError(selPais, 'activar', textoError);
        errores++;
        if (errores === 1) selPais.focus();
    }

    if (inputNroDocumento.value === "") {
        textoError = "Ingrese un número de documento";
        activarQuitarEstadoError(inputNroDocumento, 'activar', textoError);
        errores++;
        if (errores === 1) inputNroDocumento.focus();
    }
    
    if (inputEmail.value.trim() === "") {
        textoError = "Ingrese email válido";
        activarQuitarEstadoError(inputEmail, 'activar', textoError);
        errores++;
        if (errores === 1) inputEmail.focus();
    } else {
        if (!validaEmail(inputEmail.value)) {
            textoError = "E-mail (Ejm.: mail@ejemplo.com)";
            activarQuitarEstadoError(inputEmail, 'activar', textoError);
            errores++;
            if (errores === 1) inputEmail.focus();
        }
    }

    if (errores === 0) { return true; } else { return false; }
}


$(document).ready(function () {
    $(document).on('submit', '#form-register', function(e) {
        e.preventDefault();
        var dataform = $(this).serialize();
        if (validarDatos()) {
            $.ajax({
                url: PROJECT_NAME + "/register/insert",
                method: 'POST',
                data: dataform,
                beforeSend: function () { 
                    loadingOverLay("show");
                },
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.respuesta) { 
                        // alerts('alert-success', json.mensaje);
                        Swal.fire({
                            title: 'Buen trabajo!',
                            text: json.mensaje,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                          }).then((result) => {
                            if (result.value) window.location.href = BASE_URL + "login";
                          })
                    } else { 
                        alerts('alert-error', json.mensaje); 
                    }
                },
                complete: function () {
                    loadingOverLay("hide");
                }
            });
        }
    })
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


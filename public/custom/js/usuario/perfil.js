$(document).ready(function () {
    $(document).on('click', '#btn-change-password', function () {
        var form = $("#form-change-password");
        clearModal(form);
        $("#change-password").modal('show');
    }).on('shown.bs.modal', '#change-password', function () {
        $('#in-password-actual').focus();
    }).on('submit', '#form-perfil-usuario', function (e) {
        e.preventDefault();
        if (validaFormUsuario()) { updatePerfil(this); } else { return false; }
    }).on('submit', '#form-change-password', function (e) {
        console.log("entrw");
        e.preventDefault();
        if (validaFormChangePassword()) { changePassword(this); } else { return false; }
    });
});

function changePassword(form) {
    var data = $(form).serialize();
    var modal = $(form).closest(".modal.fade");
    $.ajax({
        url: PROJECT_NAME + "/usuario/changePassword",
        method: "POST",
        data: data,
        success: function (data) {
            var json = JSON.parse(data);
            $(modal).modal('hide');
            if (json.respuesta) { 
                alerts('alert-success', json.mensaje); 
            } else { 
                alerts('alert-error', json.mensaje); 
            }
        }
    });
}

function updatePerfil(form) {
    $.ajax({
        url: PROJECT_NAME + "/usuario/updatePerfil",
        method: 'POST',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            console.log(data);
            var json = JSON.parse(data);
            if (json.respuesta) { 
                alerts('alert-success', json.mensaje); 
            } else { 
                alerts('alert-error', json.mensaje); 
            }
        }
    });
}

function validaFormUsuario() {
    var formName = $("#form-perfil-usuario").attr("name");
    var form = document.getElementsByName(formName)[0];
    var formElements = form.elements;
    /* limpiar los errores si hubiera */
    for (var i = 0; i < formElements.length; i++)
            activarQuitarEstadoError(formElements[i], 'quitar');
    /* elementos a validar */
    var selTipodocumento = document.getElementById("sel-usuario-documento");
    var inputDocumento = document.getElementById("in-reniec-nrodocumento");
    var inputNombres = document.getElementById("in-reniec-nombres");
    var inputApPaterno = document.getElementById("in-reniec-appaterno");
    var inputApMaterno = document.getElementById("in-reniec-apmaterno");
    var selGenero = document.getElementById("sel-reniec-genero");
    var inputNacimiento = document.getElementById("in-reniec-fnacimiento");
    // var inputCelular = document.getElementById("in-usuario-celular");
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
    if (inputApPaterno.value.trim() === "") {
        textoError = "Ingrese ap. paterno";
        activarQuitarEstadoError(inputApPaterno, 'activar', textoError);
        errores++;
        if (errores === 1) inputApPaterno.focus();
    } else {
        if (!validaNombres(inputApPaterno.value)) {
            textoError = "Ap. paterno (sólo letras)";
            activarQuitarEstadoError(inputApPaterno, 'activar', textoError);
            errores++;
            if (errores === 1) inputApPaterno.focus();
        }
    }
    if (inputApMaterno.value.trim() === "") {
        textoError = "Ingrese ap. materno";
        activarQuitarEstadoError(inputApMaterno, 'activar', textoError);
        errores++;
        if (errores === 1) inputApMaterno.focus();
    } else {
        if (!validaNombres(inputApMaterno.value)) {
            textoError = "Ap. materno (sólo letras)";
            activarQuitarEstadoError(inputApMaterno, 'activar', textoError);
            errores++;
            if (errores === 1) inputApMaterno.focus();
        }
    }
    // if (selGenero.value === "") {
    //     textoError = "Seleccione género";
    //     activarQuitarEstadoError(selGenero, 'activar', textoError);
    //     errores++;
    //     if (errores === 1) selGenero.focus();
    // }
    // if (inputNacimiento.value === "") {
    //     textoError = "Seleccione fecha de nacimiento";
    //     activarQuitarEstadoError(inputNacimiento, 'activar', textoError);
    //     errores++;
    //     if (errores === 1) inputNacimiento.focus();
    // }
    // if (inputCelular.value.trim() !== '') {
    //     if (!validaTelefono(inputCelular.value, 'celular')) {
    //         textoError = "Celular (Ejm: 960794123)";
    //         activarQuitarEstadoError(inputCelular, 'activar', textoError);
    //         errores++;
    //         if (errores === 1) inputCelular.focus();
    //     }
    // }

    if (inputEmail.value.trim() !== '') {
        if (!validaEmail(inputEmail.value)) {
            textoError = "Ejm: mail@ejemplo.com";
            activarQuitarEstadoError(inputEmail, 'activar', textoError);
            errores++;
            if (errores === 1) inputEmail.focus();
        }
    }
    if (errores === 0) { return true; } else { return false; }
}

function validaFormChangePassword() {
    var formName = $("#form-change-password").attr("name");
    var form = document.getElementsByName(formName)[0];
    var formElements = form.elements;
    /* limpiar los errores si hubiera */
    for (var i = 0; i < formElements.length; i++)
            activarQuitarEstadoError(formElements[i], 'quitar');
    /* elementos a validar */
    var inputPasswordActual = document.getElementById("in-password-actual");
    var inputPasswordNew = document.getElementById("in-password-new");
    var inputPasswordConfirm = document.getElementById("in-password-confirm");
    var errores = 0, textoError = "";
    /* validaciones */
    if (inputPasswordActual.value === "") {
        textoError = "Ingrese contraseña actual";
        activarQuitarEstadoError(inputPasswordActual, 'activar', textoError);
        errores++;
        if (errores === 1) inputPasswordActual.focus();
    }
    if (inputPasswordNew.value === "") {
        textoError = "Ingrese nueva contraseña";
        activarQuitarEstadoError(inputPasswordNew, 'activar', textoError);
        errores++;
        if (errores === 1) inputPasswordNew.focus();
    } else {
        if (inputPasswordNew.value !== inputPasswordConfirm.value) {
            textoError = "Las contraseñas no coinciden";
            activarQuitarEstadoError(inputPasswordConfirm, 'activar', textoError);
            errores++;
            if (errores === 1) inputPasswordConfirm.focus();
        }
    }
    if (inputPasswordConfirm.value === "") {
        textoError = "Confirme nueva contraseña";
        activarQuitarEstadoError(inputPasswordConfirm, 'activar', textoError);
        errores++;
        if (errores === 1) inputPasswordConfirm.focus();
    }
    if (errores === 0) { return true; } else { return false; }
}
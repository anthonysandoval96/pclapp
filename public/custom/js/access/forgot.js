$(document).ready(function () {

    $(document).on('submit', '#form-forgot', function (e) {
        e.preventDefault();
        if (validarDatos()) {
            $.ajax({
                url: PROJECT_NAME + "/login/recuperarContrasena",
                method: 'POST',
                data: $(this).serialize(),
                success: function (data) {
                    console.log(data);
                    var json = JSON.parse(data);
                    if (json.respuesta) { 
                        alerts('alert-success', json.mensaje);
                        clearModal($("#form-forgot"));
                    } else { 
                        alerts('alert-error', json.mensaje); 
                    }
                }
            });
        }
    });

});

function validarDatos() {
    var form = document.getElementsByName("form-forgot")[0];
    var formElements = form.elements;
    var errores = 0, textoError = "";
    /* limpiar los errores si hubiera */
    for (var i = 0; i < formElements.length; i++)
        activarQuitarEstadoError(formElements[i], 'quitar');
    /* elementos a validar */
    var inputUsername = document.getElementById("in-usuario-username");
    var inputEmail = document.getElementById("in-usuario-email");

    if (inputUsername.value.trim() === "") {
        textoError = "Ingrese username";
        activarQuitarEstadoError(inputUsername, 'activar', textoError);
        errores++;
        if (errores === 1) inputUsername.focus();
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
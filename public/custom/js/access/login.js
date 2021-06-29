var usuario_or_email = $("#in-usuario-email");
var in_password = $("#in-usuario-password");
var div_mensajes = $("#eventos-campos-login");
var btn_submit = $("#btn-submit-login");
var icon_fas = "fa-sign-in-alt";
var error_message = {
    'empty': "Ingrese sus datos de acceso.",
    'usuario': "Ingrese su nombre de usuario o email.",
    'password': "Ingrese su contraseña."
};

$(document).ready(function () {
//    $(usuario_or_email).focus();
    $(document).on('submit', '#form-usuario-login', function (e) {
        e.preventDefault();
        changeSubmitIcon(btn_submit, icon_fas, 'submit');
        validaCamposLogin($(this));
    });

});

function validaCamposLogin(form) {
    var errores = 0;
    divMessageLogin('', 'clear');
    if ($(usuario_or_email).val().trim() === "" && $(in_password).val().trim() === "") {
        errores++;
        divMessageLogin(error_message['empty'], 'show');
        if (errores == 1) { $(usuario_or_email).focus(); }
    } else if ($(usuario_or_email).val().trim() === "") {
        errores++;
        divMessageLogin(error_message['usuario'], 'show');
        if (errores == 1) { $(usuario_or_email).focus(); }
    } else if ($(in_password).val().trim() === "") {
        errores++;
        divMessageLogin(error_message['password'], 'show');
        if (errores == 1) { $(in_password).focus(); }
    }
    if (errores > 0) { 
        changeSubmitIcon(btn_submit, icon_fas, "error");
        return false; 
    } else { checkLogin(form); }
}

function checkLogin(form) {
    var data = form.serialize();
    $.ajax({
        url: PROJECT_NAME + "/login/loginer",
        method: 'POST',
        data: data,
        success: function (data) {
            var json = JSON.parse(data);
            if (json.respuesta) { 
                window.location = BASE_URL + "home";
            } else { 
                changeSubmitIcon(btn_submit, icon_fas, 'error');
                divMessageLogin(json.mensaje, 'show');
            }
        }
    }).fail( function() { 
        changeSubmitIcon(btn_submit, icon_fas, 'error');
    });
}

function divMessageLogin(message, tipo) {
    if (tipo === "show") {
        $(div_mensajes).html("<p class='mx-auto'>" + message + "</p>");
    } else if (tipo === "clear") { $(div_mensajes).html(""); }
}
$(document).ready(function() {
    $.ajax({
        url: PROJECT_NAME + "/register/insert",
        method: 'POST',
        data: "",
        success: function (data) {
            var json = JSON.parse(data);
            if (json.respuesta) { 
                toasts("success", json.mensaje);
            } else { 
                toasts("error", json.mensaje);
            }
        }
    });
});
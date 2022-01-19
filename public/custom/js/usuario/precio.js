$(document).ready(function () {
    $(document).on('click', '#btn-action', function () {
        $("#form-precio").submit();
    }).on('submit', '#form-precio', function (e) {
        e.preventDefault();
        $.ajax({
            url: PROJECT_NAME + "/usuario/updatePrecio",
            method: 'POST',
            data: $(this).serialize(),
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
    });
});
var sesiones = $("#body-sesiones");
$(document).ready(function() {
    $(document).on('click', '#btn-empezar', function() {
        window.location = BASE_URL + "sesion";
    })
    $.ajax({
        url: PROJECT_NAME + "/usuario/get_sesiones",
        method: 'POST',
        data: '',
        success: function (data) { 
            console.log(data);
            var json = JSON.parse(data);
            let bodyhtml = "";
            if (!$.isEmptyObject(json)) {
                jQuery.each(json, function(k,v) {
                    bodyhtml += load_progress_sesion(v.porcentaje, v.numero)
                });
            }
            $(sesiones).html(bodyhtml).fadeIn(500);
        }
    });
});

function load_progress_sesion(percent = 0, num = 1) {
    var porcentaje = percent;
    var sesion = num;
    var txtsesion = "Sesión " + sesion;
    var html = `
        <div class='col-6 col-md-4 col-lg-3 my-2'>
            <div class='progress'>
                <div class='progress-bar' role='progressbar' style='width: `+porcentaje+`%; background-color: #fd7e14;'
                     aria-valuenow='`+porcentaje+`' aria-valuemin='0' aria-valuemax='100'>`+parseFloat(porcentaje).toFixed(2)+`%
                </div>
            </div>
            <div class="text-center mt-1">`+txtsesion+`</div>
        </div>`;
    return html;
}
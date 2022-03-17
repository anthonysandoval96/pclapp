let btn_add = $('#btn-add');
var loader = $(".spinner-border");

var classAvatar = "avatar w-100 rounded";

$(document).ready(function() {
    
    $(document).on('click', "#link-accion-logut", function (e) {
        e.preventDefault();
        logut();
    });

    $("#file-upload").change(function () { pasarInfoDocument(); });

    $("#btn-cancelar-avatar").click(function () {
        var carpeta = $(this).attr("data-avatar");
        var imgrecorded = $(this).attr("data-imgrecorded");
        var srcimg = BASE_URL + "public/custom/img/" + carpeta + "/"+imgrecorded;
        $(".avatar-default").html(html_avatar(classAvatar, srcimg));
        $(".avatar-change").removeClass("hide");
        $("#info").html("");
        $("#file-upload").val("");
    });
});

function changeSubmitIcon(btn, icon_original, tipo, fas='fas') {
    var icon_spinner = "fa-spinner fa-pulse";
    var icon = $(btn).find("i."+fas);
    if (tipo === "error") {
        if (fas == "far") icon = icon.removeClass("fas").addClass("far");
        $(btn).removeClass("disabled");
        $(icon).removeClass(icon_spinner).addClass(icon_original);
    } else if (tipo === "submit") {
        if (fas == "far") icon = icon.removeClass(fas).addClass("fas");
        if ($(btn).hasClass("disabled")) { return false; }
        $(btn).addClass("disabled");
        $(icon).removeClass(icon_original).addClass(icon_spinner);
    } else { return false; }
}

function logut() {
    $.ajax({
        url: PROJECT_NAME + "/login/logut",
        method: 'POST',
        data: '',
        success: function (a) { window.location.href = BASE_URL + "login"; }
    });
}

function pasarInfoDocument() {
    var inputFileImage = document.getElementById('file-upload').files[0];
    document.getElementById('info').innerHTML = inputFileImage.name;

    var reader = new FileReader();
    reader.onload = function (e) {
        $("#avatar-upload").remove();
        $(".avatar-change").addClass("hide");
        $(".avatar-default").html(html_avatar(classAvatar, e.target.result));
    }
    reader.readAsDataURL(inputFileImage);
}

function validaNombres(valor, alfa) {
    valor = valor.trim();
    var rxNombres = /^[a-zA-ZÀ-ú. ]{2,40}$/;
    if (alfa) {
        rxNombres = /^[a-zA-ZÀ-ú0-9.,-_' ]{2,100}$/;
    }
    return rxNombres.test(valor);
}

function validateDocumento(ruc) {
    var rxNumero = /^\d+$/;
    var rucPrimerCaracter = ruc.split('')[0];
    if ((ruc.length == 11 && rxNumero.test(ruc)) 
        && (rucPrimerCaracter == '1' || rucPrimerCaracter == '2')) {
        return true;
    } else {
        return false;
    }
}

function validaDocumento(valor, tipo) {
    valor = valor.trim();
    var rxNumero = /^\d+$/;
    var rxPasaporte = /^[a-zA-Z0-9-]{7,}$/;
    var cantidadMinima;
    if (tipo === 'dni')
        cantidadMinima = 8;
    else if (tipo === 'pasaporte')
        cantidadMinima = 7;
    else
        cantidadMinima = 11; // ruc
    var errores = 0;

    if ((valor.length < cantidadMinima) || (tipo === 'dni' && valor.length > 8)) {
        errores++;
    } else if (tipo === 'dni' || tipo === 'ruc') {
        if (!(rxNumero.test(valor))) {
            errores++;
        } else if (tipo === 'ruc') {
            var rucPrimerCaracter = valor.split('')[0];
            if (rucPrimerCaracter !== '1' && rucPrimerCaracter !== '2') {
                errores++;
            }
        }
    } else if (tipo === 'pasaporte') {
        if (!(rxPasaporte.test(valor))) {
            errores++;
        }
    }
    return errores === 0;
}

function validaEmail(valor) {
    valor = valor.trim();
    var rxEmail = /^[A-Za-z][A-Za-z0-9._-]*@[A-Za-z0-9_-]+\.[A-Za-z0-9_.]+[A-za-z]$/;
    return rxEmail.test(valor);
}

function validaUsuario(valor) {
    valor = valor.trim();
    var rxUsuario = /^[a-zA-Z0-9]{2,15}$/;
    return rxUsuario.test(valor);
}

function validaPassword(pass) {
    pass = pass.trim();
    return (pass.length > 4);
}

function validaTelefono(valor, tipo) {
    valor = valor.trim();
    var rxPhone1 = /^\d{9}$/; // cel
    var rxPhone2 = /^\+\d{2,3}\s\d{9}$/; // cel
    var rxPhone3 = /^#\d{6,9}$/; // tel-cel
    var rxPhone4 = /^\d{2,3}\s\d{6,7}$/; // tel
    var rxPhone5 = /^\*\d{6}$/; // tel
    var rxPhone6 = /^\d{2,3}-\d{6,7}$/; // tel
    var rxPhone7 = /^\d{6}$/; // tel
    var errors = 0;
    if (tipo === 'celular') {
        if (!(rxPhone1.test(valor) || rxPhone2.test(valor) || rxPhone3.test(valor))) {
            errors++;
        }
    } else if (tipo === 'fijo') {
        if (!(rxPhone1.test(valor) || rxPhone3.test(valor) || rxPhone4.test(valor) || rxPhone5.test(valor)
                || rxPhone6.test(valor) || rxPhone7.test(valor))) {
            errors++;
        }
    }
    return errors === 0;
}

function process_modal(el, op, ajax = false) {
    if (op !== "eliminar") {
        let name_modal = el.attr('data-modal');
        let parts =  name_modal.split('-');
        let controller = parts[1];
        if (parts.length > 2) controller = parts[2];
        let modal = $('#' + name_modal);
        let form = modal.find('form');
        clearModal(form);
        form.attr("data-op", op);
        if (controller == "usuario") {
            // limpiarCamposReniec($("#btn-search-empleado"));
            $(".nav-link[data-pos='1']").click();
            modal.find("#btn-action-prev").addClass("d-none");
            modal.find("#btn-action-next").text("Siguiente");
        } else {
            modal.find('.modal-title').text(ucfirst(op) + ' ' + ucfirst(controller));
            modal.find('.btn-action').text(ucfirst(op));
        }
        if (ajax === true) {
            loadingOverLay("show");
            setTimeout(function() {
                loadingOverLay("hide");
                modal.modal('show');
            }, 1500);
        } else {
            modal.modal('show');
        }
    }
}

function clearModal(form) {
    form.find(".fields-errors").hide();
    form.find(".form-control").css('border-color', '');
    form[0].reset();
    form.find(".select2bs4").val("").change();
}

function ucfirst(str) {
    var text = str;
    if (text) {
        var parts = text.split(' '),
                len = parts.length,
                i, words = [];
        for (i = 0; i < 1; i++) {
            var part = parts[i];
            var first = part[0].toUpperCase();
            var rest = part.substring(1, part.length);
            var word = first + rest;
            words.push(word);
        }
        return words.join(' ');
    }
    return false;
}

function toasts(tipo, mensaje) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000
    });
    switch (tipo) {
        case 'success':
            Toast.fire({
                type: 'success',
                title: mensaje
            });
            break;
        case 'warning':
            Toast.fire({
                type: 'warning',
                title: mensaje
            });
            break;
        case 'info':
            Toast.fire({
                type: 'info',
                title: mensaje
            });
            break;
        case 'error':
            Toast.fire({
                type: 'error',
                title: mensaje
            });
            break;
    }
}

function alerts(tipo, mensaje, title = '') {
    switch (tipo) {
        case 'alert-success':
            Swal.fire({
                type: 'success',
                title: 'Buen trabajo!',
                html: mensaje,
                showConfirmButton: true
            });
            break;
        case 'alert-error':
            Swal.fire({
                type: 'error',
                title: 'Ocurrió un error!',
                html: mensaje
            });
            break;
        case 'alert-info':
            Swal.fire({
                type: 'info',
                title: title,
                html: mensaje
            });
            break;
        case 'alert-warning':
            Swal.fire({
                type: 'warning',
                title: title,
                html: mensaje
            });
            break;
    }
}

function activarQuitarEstadoError(elem, estado, msg) {
    var splitId = elem.id.split('-');
    var errorElem = document.getElementById("error-" + splitId[1] + "-" + splitId[2]);
    if (estado === 'activar') {
        $(errorElem).css("display", "inline-block");
        if (msg !== null) {
            errorElem.innerHTML = msg;
        }
        $(elem).css('border-color', '#e2a2a2');
    } else if (estado === 'quitar') {
        $(errorElem).hide().html('');
        $(elem).css('border-color', '');
    }
    return errorElem;
}

function getPluralPrase(phrase, type = 'min') {
    var plural = '';
    var last_character = phrase.substr(-1);
    if (last_character == 'y') {
        plural += phrase.substr(0, (phrase.length - 1)) + 'ies';
    } else if ((last_character == 'a' || last_character == 'e' || last_character == 'i' || last_character == 'o' || last_character == 'u')) {
        plural += phrase + 's';
    } else {
        plural += phrase + 'es';
    }
    if (type == 'may') plural = ucfirst(plural);
    return plural;
}

function loadingOverLay(type) {
    if (type == "show") {
        $(".spanner.transaction").show();
        $("body").append("<div class='modal-backdrop fade show'></div>");
    } else if (type == "hide") {
        $(".modal-backdrop.show").remove();
        $(".spanner.transaction").hide();
    } else {
        return false;
    }
}

function loadingOverLayTwo(type) {
    if (type == "show") {
        $(".spanner.ajaxdata").show();
        $("body").append("<div class='modal-backdrop fade show'></div>");
    } else if (type == "hide") {
        $(".modal-backdrop.show").remove();
        $(".spanner.ajaxdata").hide();
    } else {
        return false;
    }
}

function html_avatar(class_avat, src_img) {
    var html = `<div class='row'>
        <div class="col-6 col-lg-12 m-auto">
            <img id="avatar-upload" class="`+class_avat+`" src="`+src_img+`"/>
        </div>
    </div>`;
    return html;
}

function getLetterLine(number) {
    var letra = "a";
    if (number == 1) {
        letra = "a";
    } else if (number == 2) {
        letra = "b";
    } else if (number == 3) {
        letra = "c";
    } else if (number == 4) {
        letra = "d";
    } else if (number == 5) {
        letra = "e";
    } else {
        return false;
    }
    return letra;
}
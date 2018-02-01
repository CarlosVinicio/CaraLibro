$(function () {
    $('#privateMail').click(function () {

        var codigoDestino = $('#codigoDestino').val();
        var mensajeEnviar = $('#mensajeEnviar').val();
        var asunto = $('#asunto').val();

        $.ajax({
            type: "POST",
            url: "ejecutarEnvioMensaje.php",
            data: {
                codigoDestino: codigoDestino,
                mensajeEnviar: mensajeEnviar,
                asunto: asunto
            },
            success: function (datos) {

                if (datos.search('Error') == -1) { // no hubo errores
                    $('#comprobarEnvio').html('<div class="alert alert-success" role="alert">' + datos + "</div>");

                    setTimeout(function () {
                        location.reload(); // la pagina se recarga borrando los campos de asunto y mensaje MIRAR A VER SI NO DA ALGUN posible error derivado de esta recarga
                    }, 1500);
                } else { // hubo errores
                    $('#comprobarEnvio').html('<div class="alert alert-danger" role="alert">' + datos + "</div>");

                }
            }
        })
    });
})

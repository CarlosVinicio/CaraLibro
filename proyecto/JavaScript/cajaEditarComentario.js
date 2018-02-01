$(document).ready(function () {

    $('.caja-para-editar').hide();
    $('.confirmar-cambio').hide();

    $('.editar').click(function () {

        var texto = $(this).parents('.ultima-publicacion').find('.texto').html();
        var confirmaCambio = $(this).parents('.ultima-publicacion').find('.confirmar-cambio').show();
        var cajaOcultada = $(this).parents('.ultima-publicacion').find('.ocultar-caja').hide()
        var cajaParaEditar = $(this).parents('.ultima-publicacion').find('.caja-para-editar').show();

        cajaParaEditar.html(texto);
        cajaOcultada.hide();

        confirmaCambio.click(function () {

            var idPublicacion = $(this).parents(".ultima-publicacion").children(".idPublicacion").html();
            
            var textoNuevo = $(this).parents('.ultima-publicacion').find('.caja-para-editar').val();
            cajaParaEditar.hide();

            var ocultarCaja = $(this).parents('.ultima-publicacion').find('.ocultar-caja').show();
            ocultarCaja.html(textoNuevo);
            confirmaCambio.hide();

            $.ajax({
                type: "GET",
                url: "../publicaciones/modificarPublicacion.php",
                data: "idPublicacion=" + idPublicacion + "&cuerpo=" + textoNuevo,
                success: function (datos) {

                }
            });
        });
    });
})

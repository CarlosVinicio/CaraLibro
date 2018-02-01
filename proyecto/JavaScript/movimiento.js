$(document).ready(function () {

    $(".mostrarCaja").click(function () {

        if ($(this).parents('.mensajeMostrado').find('.cajaMostrada').hasClass('cajaMostradaOculta')) {

            $(this).parents('.mensajeMostrado').find('.mostrarCaja').removeClass('glyphicon glyphicon-plus').addClass('glyphicon glyphicon-minus');
            $(this).parents('.mensajeMostrado').find('.cajaMostrada').removeClass('cajaMostradaOculta').addClass('cajaMostradaVisible');

        } else {

            $(this).parents('.mensajeMostrado').find('.mostrarCaja').removeClass('glyphicon glyphicon-minus').addClass('glyphicon glyphicon-plus');
            $(this).parents('.mensajeMostrado').find('.cajaMostrada').removeClass('cajaMostradaVisible').addClass('cajaMostradaOculta');
        }
    })
})

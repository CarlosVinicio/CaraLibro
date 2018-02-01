$(function () {
    $(".meGusta").click(function () {
        
        var idPublicacion = $(this).parents(".ultima-publicacion").children(".idPublicacion").html();
        var boton = $(this);
        $.ajax({

            type: "GET",
            url: "../publicaciones/darMeGusta.php",
            data: "&idPublicacion=" + idPublicacion,
            success: function (datos) {
                datos = datos.trim();
                boton.html(datos);
            }
        });
    });

    $(".noMeGusta").click(function () {
        var idPublicacion = $(this).parents(".ultima-publicacion").children(".idPublicacion").html();
         var boton2 = $(this);
        $.ajax({
            type: "GET",
            url: "../publicaciones/darNoMeGusta.php",
            data: "&idPublicacion=" + idPublicacion,
            success: function (datos) {
                datos = datos.trim();
                boton2.html(datos);
            }
        });
    });
})

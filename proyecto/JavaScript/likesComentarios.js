$(function () {
    $(".noMeGustaComen").click(function (e) {

        e.preventDefault(); // previene q la pagina no se recagr a darle dislike de comentarios

        var idComentario = $(this).prevAll('.codigoComentario').val();
        var boton = $(this)

        $.ajax({
            type: "GET",
            url: "../publicaciones/darNoMeGustaComentario.php",
            data: {
                idComentario: idComentario
            },
            success: function (datos) {
                datos = datos.trim();
                boton.html(datos);
            }
        });
    });

    $(".meGustaComen").click(function (e) {
        e.preventDefault(); // previene q la pagina no se recagr a darle dislike de comentarios

        var idComentario = $(this).prevAll('.codigoComentario').val();
        var boton2 = $(this)

        $.ajax({
            type: "GET",
            url: "../publicaciones/darMeGustaComentario.php",
            data: {
                idComentario: idComentario
            },
            success: function (datos) {
                datos = datos.trim();
                boton2.html(datos);
            }
        });
    });
})

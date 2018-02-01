$(function () {
    $("#enviarPublicacion").click(function () {

        //var comentario = $(this).parents("#publicacionAIntroducir").children("#comentarioPublicacion").val();
        var publicacion = $(this).parents("#publicacionAIntroducir").find("#publicacionPublicacion").val();
        console.log(publicacion);
        $.ajax({
            type: "GET",
            url: "../publicaciones/insertarPublicacion.php",
            data: "&publicacion=" + publicacion,
            success: function (datos) {
                if (datos) {
                    
                    location.reload();
                } else {
                    alert("No se ha creado el comentario");
                }
            }
        });
    });
})

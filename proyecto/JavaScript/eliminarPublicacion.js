$(function () {
    
    
    $(".eliminar").click(function () {
        var idPublicacion = $(this).parents(".ultima-publicacion").children(".idPublicacion").html();

        $.ajax({
            type: "GET",
            url: "../publicaciones/eliminarPublicacion.php",
            data: "idPublicacion=" + idPublicacion,
            success: function (datos) {
                
                location.reload();
//                if (datos == true) {
//                    alert("Se ha eliminado la publicación");
//                } else {
//                    alert("No se ha eliminado la publicación");
//                }
            }
        });
    });
})

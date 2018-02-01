$(function () {
    
    $(".enviarComentario").click(function () {
        var comentario = $(this).parents(".comentarioAIntroducir").find(".publicarComentario").val();
        
        var idPublicacion = $(this).parents(".ultima-publicacion").children(".idPublicacion").html();

        $.ajax({
            type: "GET",
            url: "../publicaciones/insertarComentario.php",
            //data: "&comentario=" + comentario,
            data:{
                comentario: comentario,
                idPublicacion: idPublicacion
            },
            
            success: function (datos) {
                console.log(datos);
               location.reload();
            }
        });
    });
    
    
    
})

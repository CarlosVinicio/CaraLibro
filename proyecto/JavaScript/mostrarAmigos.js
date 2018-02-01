$(document).ready(function () {

    $('#mostrarAmigos').click(function () {
        $.ajax({
            //async:false,
            type: "GET",
            url: "../amigos/visualizarContactos.php",
            async: false,
            success: function (datos) {

                var usuariosEncontrados = JSON.parse(datos);
                var html = "";

                if (usuariosEncontrados.length > 0) {
                    html += '<div class="list-content"><ul class="list-group"><li href="#" class="list-group-item title">Listados de amigos</li>';

                    for (var i = 0; i < usuariosEncontrados.length; i++) {

                        html += '<li href="#" class="list-group-item text-left usuarioMostrado">';
                        html += '<img class="img-thumbnail" src="' + usuariosEncontrados[i][6] + '" alt="No se puede cargar la imagen del usuario" class="imagenUsuario"/>'
                        html += '<label class="name">' + usuariosEncontrados[i][2] + " " + usuariosEncontrados[i][3] + '</label>';
                        html += "<input type='hidden' class='idUsuarioEncontrado' value = '" + usuariosEncontrados[i][0] + "' />";
                        html += '<span class="pull-right">';
                        html += '<button type="button" class="btn btn-success btn-xs glyphicon glyphicon-eye-open verPerfil">';
                        html += '<button type="button" class="btn btn-info btn-xs glyphicon glyphicon glyphicon-comment enviarMensaje">';
                        html += '<button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash eliminarAmigo">';
                        html += '</span>'
                        html += '<div class="break"></div>'
                        html += '</li>';

                    }
                    html += '</ul></div>';

                    $("#contenedorPublicaciones").html(html);

                } else {

                    $("#contenedorPublicaciones").html('<div class="alert alert-danger" role="alert">Aún no tienes amigos!</div>');
                }
            }
        });
        
        $('.verPerfil').click(function() {
            var idUsuario = $(this).parents('.usuarioMostrado').children('.idUsuarioEncontrado').val();
            
             window.location.href = "../muroAmigo/muroAmigo.php?idUsuario= " + idUsuario + "";
        })

        $('.enviarMensaje').click(function () {
            var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();
            var nombreApe = $(this).parents('.usuarioMostrado').children(".name").html();

            window.location.href = "../amigos/sendEmail.php?usuarioDestino=" + usuarioDestino + "&nombreApe=" + nombreApe + "";
        });

        $('.eliminarAmigo').click(function () {
            var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();

            $.ajax({
                type: "GET",

                url: "../amigos/eliminarAmigos.php",
                data: {
                    usuarioDestino: usuarioDestino
                },
                success: function (datos) {
                    console.log(datos);

                    location.reload();

                    //-------------------------------------------------------
                }
            })
        });
    })
});

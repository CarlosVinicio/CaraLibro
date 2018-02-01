$(document).ready(function () {
    $("#buscarUsuario").click(function () {


        //var apellidos = $("#apellidosUsuarioBuscar").val() + "";
        var nombre = $("#nombreUsuarioBuscar").val();
        var apellidos = $("#apellidosUsuarioBuscar").val();
        var codigoUsuario = $('#codigoUsuario').val();


        if (nombre != "" || apellidos != "") {
            $.ajax({
                type: "GET",
                url: "../buscarUsuario.php",
                //data: "nombre=" + nombre + "&apellidos=" + apellidos,
                data: {
                    nombre: nombre,
                    apellidos: apellidos,
                    codigoUsuario: codigoUsuario
                },
                async: false,
                success: function (datos) {

                    var usuariosEncontrados = JSON.parse(datos);
                    var html = "";

                    if (usuariosEncontrados.length != 0) {
                        html += '<div class="list-content"><ul class="list-group"><li href="#" class="list-group-item title">Resultados de la busqueda</li>';

                        for (var i = 0; i < usuariosEncontrados.length; i++) {

                            html += '<li href="#" class="list-group-item text-left usuarioMostrado">';

                            html += '<img class="img-thumbnail" src="' + usuariosEncontrados[i][6] + '" alt="No se puede cargar la imagen del usuario" class="imagenUsuario"/>'
                            html += '<label class="name">' + usuariosEncontrados[i][2] + " " + usuariosEncontrados[i][3] + '</label>';
                            html += "<input type='hidden' class='idUsuarioEncontrado' value = '" + usuariosEncontrados[i][0] + "' />";
                            html += '<span class="pull-right">';
                            html += '<button type="button" class="btn btn-success btn-xs glyphicon glyphicon-plus-sign enviarSolicitud">';
                            html += '<button type="button" class="btn btn-info btn-xs glyphicon glyphicon glyphicon-comment enviarMensaje">';

                            html += '</span>'
                            html += '<div class="break"></div>'
                            html += '</li>';

                        }
                        html += '</ul></div>';
                    } else {

                        html += '<div class="alert alert-danger"><strong> ' + "Lo sentimos, pero no hay coincidencias con su busqueda." + '</strong> </div>';
                    }

                    $("#contenedorPublicaciones").html(html);

                }
            });

            $(".enviarSolicitud").click(function () {
                var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();
                if (usuarioDestino != "") {
                    $.ajax({
                        type: "GET",
                        url: "../amigos/annadirAmigo.php",
                        data: "receptor=" + usuarioDestino,
                        success: function (datos) {

                            var estadoSolicitud;

                            if (datos) {
                                estadoSolicitud = "La solicitud ha sido enviada correctamente!";
                                $("#contenedorPublicaciones").html('<div class="alert alert-success"><strong> ' + estadoSolicitud + '</strong> </div>');
                            } else {
                                //estadoSolicitud = "Esto es emabarozo, parece que no se ha podido mandar";

                                estadoSolicitud = 'Parece que ya sois amigos o existe una solicitud pendiente!';

                                $("#contenedorPublicaciones").html('<div class="alert alert-warning"><strong> ' + estadoSolicitud + '</strong> </div>');

                            }

                        }
                    });
                }
            });

            $('.enviarMensaje').click(function () {

                var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();
                var nombreApe = $(this).parents('.usuarioMostrado').children(".name").html();

                window.location.href = "../amigos/sendEmail.php?usuarioDestino=" + usuarioDestino + "&nombreApe=" + nombreApe + "";

            });



        } else {
            //$('#contenedorPublicaciones').html('');
            $("#contenedorPublicaciones").html('<div class="alert alert-danger"><strong> ' + "Debes introducir algun criterio de busqueda." + '</strong> </div>');
        }
    });
});

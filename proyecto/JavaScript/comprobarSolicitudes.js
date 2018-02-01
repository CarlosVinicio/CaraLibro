$(document).ready(function () {

    //Funcion que al dar al desplegable nos dice el numero de notificaciones que tenemos tanto de amistad como de publicaciones
    $('.dropdown-toggle').click(function () {

        $.ajax({
            type: "GET",
            url: "../amigos/comprobarSolicitudes.php",
            success: function (datos) {

                var numeroSolicitudes = JSON.parse(datos).length;
                if (numeroSolicitudes > 0) {

                    $('.comprobarSolicitudes').html('<span style= "color: red; margin-left:5px; font-weight: 600">' + numeroSolicitudes + '</span>');
                } else {
                    $('.comprobarSolicitudes').html('<span style= "margin-left:5px; font-weight: 600">' + numeroSolicitudes + '</span>');

                }
            }
        })
    })

    $(".comprobarSolicitudes").click(function () {
        $.ajax({
            type: "GET",
            url: "../amigos/comprobarSolicitudes.php",
            async: false,
            success: function (datos) {

                var solicitudesEncontradas = JSON.parse(datos);
                var mostrarSolicitudes = "";
                var html = "";


                if (solicitudesEncontradas.length > 0) {
                    html += '<div class="list-content"><ul class="list-group"><li href="#" class="list-group-item title">Solicitudes de amistad pendientes</li>';

                    for (var i = 0; i < solicitudesEncontradas.length; i++) {

                        html += '<li href="#" class="list-group-item text-left usuarioMostrado">';
                        html += '<img class="img-thumbnail" src="' + solicitudesEncontradas[i][6] + '" alt="No se puede cargar la imagen del usuario" class="imagenUsuario"/>'
                        html += '<label class="name">' + solicitudesEncontradas[i][2] + " " + solicitudesEncontradas[i][3] + '</label>';
                        html += "<input type='hidden' class='idUsuarioEncontrado' value = '" + solicitudesEncontradas[i][0] + "' />";
                        html += '<span class="pull-right">';
                        html += '<button type="button" class="btn btn-success btn-xs glyphicon glyphicon-ok aceptarSolicitud">';
                        html += '<button type="button" class="btn btn-info  btn-xs glyphicon glyphicon glyphicon-comment enviarMensaje">';
                        html += '<button type="button" class="btn btn-danger btn-xs glyphicon glyphicon glyphicon-remove rechazarSolicitud">';
                        html += '</span>'
                        html += '<div class="break"></div>'
                        html += '</li>';

                    }
                    html += '</ul></div>';
                } else {

                    html += '<div class="alert alert-warning"><strong> ' + 'Parece que no tienes solicitudes de amistad pendientes' + '</strong> </div>';
                    //html += "Parece que no tienes solicitudes de amistad pendientes";
                }

                $("#contenedorPublicaciones").html(html);
            }
        });

        $(".aceptarSolicitud").click(function () { // funcion para aceptar solicitudes

            var usuarioDestino = $(this).parents('.usuarioMostrado').children('.idUsuarioEncontrado').val();

            if (usuarioDestino != "") {
                $.ajax({
                    type: "GET",
                    url: "../amigos/confirmarSolicitudAmistad.php",
                    data: "&segundoUsuario=" + usuarioDestino,
                    success: function (datos) {

                        var resultado = JSON.parse(datos);
                        var estadoSolicitud;

                        if (resultado) {
                            estadoSolicitud = "Genial, ahora sois amigos!";

                            $("#contenedorPublicaciones").html('<div class="alert alert-success"><strong> ' + estadoSolicitud + '</strong> </div>');

                        } else {
                            estadoSolicitud = "Esto es emabarozo, parece que no se ha podido aceptar";

                            $("#contenedorPublicaciones").html('<div class="alert alert-warning"><strong> ' + estadoSolicitud + '</strong> </div>');
                        }

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });


        $('.enviarMensaje').click(function () {

            var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();
            var nombreApe = $(this).parents('.usuarioMostrado').children(".name").html();

            window.location.href = "../amigos/sendEmail.php?usuarioDestino=" + usuarioDestino + "&nombreApe=" + nombreApe + "";

        });


        $('.rechazarSolicitud').click(function () {
            var usuarioDestino = $(this).parents('.usuarioMostrado').children(".idUsuarioEncontrado").val();

            $.ajax({
                type: "GET",
                url: "../amigos/rechazarSolicitud.php",
                data: {
                    idUsuRechazar: usuarioDestino
                },
                success: function (datos) {
                    console.log(datos)

                    if (datos) {
                        location.reload();
                    }
                }
            });

        })
    });


});

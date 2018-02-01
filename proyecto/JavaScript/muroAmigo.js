$(document).ready(function () {
    var imagen = ""
    var nombre = ""
    var apellidos = ""

    var idAmigo = $('#idAmigo').val();

        $.ajax({
        type: "GET",
        async: false,
        url: "../publicaciones/obtener-datos.php",
        data: "&idAmigo=" + idAmigo,
        success: function (datosAmigo) {
            var arraydatos = JSON.parse(datosAmigo);
            $('#datos-muro').append("<h3 id='nombre'> " + arraydatos[0] + ' ' + arraydatos[1] + "</h3>")
            $('#datos-muro').append("<div id='fechaNacimiento'><b>F.Nac:</b>" + arraydatos[2] + "</div>")
            $('#datos-muro').append("<div id='sexo'><b>Sexo</b>: " + arraydatos[3] + "</div>")
            nombre = arraydatos[0]
            apellidos = arraydatos[1]
        }
    })
    $.ajax({
        type: "GET",
        async: false,

        data: "&idAmigo=" + idAmigo,

        url: "../publicaciones/obtener-imagen.php",
        success: function (datos) {
            console.log(datos)
            $('#cajaFoto').append("<img id = 'foto-perfil' src='" + datos + "' id='imagenMuro'>")
            imagen = datos
        }
    });



    $.ajax({
        type: "GET",
        async: false,
        url: "../publicaciones/obtener-publicaciones.php",
        data: "&idAmigo=" + idAmigo,

        success: function (publicaciones) {
            var arrayPublicaciones = JSON.parse(publicaciones);
            if (arrayPublicaciones != false) {
                for (var i = 0; i < arrayPublicaciones.length; i++) {
                    
                    
                    var publicacion = $("<div class='ultima-publicacion'></div>")
                    
                    publicacion.append("<span  class = 'idPublicacion " +arrayPublicaciones[i][0] + "'> " +arrayPublicaciones[i][0] + " </span>");

                    publicacion.append("<div class = 'colorFondo'><span class='fotoPublicacion'><img  src=" + imagen + " id='imagenPublicacion' class = 'tamanoImagen'/></span><span class='nombreApellidos'>" + nombre + " " + apellidos + "</span><span class='fechaPublicacion alinear-derecha'>" + arrayPublicaciones[i][3] + "</span></div>")
                    
                    publicacion.append("<div class='texto ocultar-caja'>" + arrayPublicaciones[i][2] + "</div>");
                    
 
                    publicacion.append('<div></div>');
                    
                    publicacion.append("<div class=''></div>");
                 
                    publicacion.append("<div class = 'margenTB'><button class='btn btn-info btn-xs glyphicon glyphicon-thumbs-up meGusta'>" + arrayPublicaciones[i][4] + "</button> <button class='btn btn-info btn-xs glyphicon glyphicon-thumbs-up noMeGusta'>" + arrayPublicaciones[i][5] + "</button></div>")
                    

                    publicacion.append('<div class = "comentarioAIntroducir"><input class="form-control publicarComentario" placeholder="Escribe un comentario" name="envio-publi" /><input type="button" class = "enviarComentario btn btn-success btn btn-default btn-xs" value="Comentar"/></div>');
                    
                    var comentarios = $("<div></div>")
                          
                    if (arrayPublicaciones[i][6] != false) {
                        for (var j = 0; j < arrayPublicaciones[i][6].length; j++) {
                            comentarios.append("<div class='comentarios'><span class='fotoCreadorComentario '><img class= 'imagenComentario' src=" + arrayPublicaciones[i][6][j][9][2] + "></span><b><span class='nombreApellidosCreadorComentario'>" + arrayPublicaciones[i][6][j][9][0] + " " + arrayPublicaciones[i][6][j][9][1] + "</span></b><span class = 'fechaComentario alinear-derecha'>" + arrayPublicaciones[i][6][j][4] + " </span><div class='textoComentario'>" + arrayPublicaciones[i][6][j][3] + "</div><input type = 'hidden' class = 'codigoComentario' value ='" +arrayPublicaciones[i][6][j][0] + "' /><div class='btn btn-warning btn-xs glyphicon glyphicon-thumbs-up meGustaComen'>" + arrayPublicaciones[i][6][j][5] + "</div> <div class='btn btn-warning btn-xs glyphicon glyphicon-thumbs-down noMeGustaComen'>" + arrayPublicaciones[i][6][j][6] + "</div></div>");
                            
                        }
                        //+  "<input type = 'text' class = 'codigoComentario' value ='" +arrayPublicaciones[i][6][j][0] + "' />" +

                        publicacion.append(comentarios)
                    } else {
                        publicacion.append("<div id='sinComentarios'>Esta publicacion aun no tiene ningun comentario</div>")
                    }
                    
                    $('#publicaciones').append(publicacion)
                }
            } else {
                $('#publicaciones').append("<div id='sinPublicaciones'>Tu amigo aun no ha realizado ninguna publicación</div>")
            }
        }
    })
})

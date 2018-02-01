<?php

class FunctionesGenerales {

    private $conexion;
    
    function __construct() {
        
        $this->conexion = new mysqli('localhost', "root", "", "caralibro");

    }

    function cargarImagenPerfil($id_usuario) {

        $sql = "SELECT * from usuarios where codigoUsuario = $id_usuario";
        $consulta = $this->conexion->query($sql);
        
        if ($consulta->num_rows > 0 ) {
            while ($fila = $consulta->fetch_assoc()) {
                 
                # code...
                return array($fila['nombre'], $fila['apellido'], $fila['imagen'], $fila['sexo']);
            }
        }

    }
    
    function cargarMuroGeneral($codigoUsuario) {

        
        $devolverArray = array();
        $publicacionApintar = "";
        
        $sql = "Select * from publicaciones
                where 
                codigoUsuario = $codigoUsuario or
                codigoUsuario IN (Select codigoUsuario from amigos where codigoUsuario = $codigoUsuario or codigoAmigo = $codigoUsuario AND estadoAmistad = 'T') 
                OR codigoUsuario IN (SELECT codigoAmigo from amigos where codigoUsuario = $codigoUsuario or codigoAmigo = $codigoUsuario and estadoAmistad = 'T')
                ORDER BY codigoPublicacion DESC";
        
        $resultado = $this->conexion->query($sql);

        
        while ($fila = $resultado->fetch_assoc()) {
           
            $resultado1 = $this->conexion->query("select * from usuarios where codigoUsuario = '" . $fila['codigoUsuario'] . "' ");
                                                                                     
            $fila1 = $resultado1->fetch_assoc();

            $publicacionApintar =  
            '<div class = "ultima-publicacion panel panel-warning">
            
                <span class = "idPublicacion ' . $fila['codigoPublicacion'] .'"> '. $fila['codigoPublicacion'] .  '</span>
                
                
                <div class = "colorFondo">
                    <span > <img class = "tamanoImagen" src = "' . $fila1['imagen'] . '" </img> ' . $fila1['nombre'] . ' ' . $fila1['apellido'] . '  </span>
                    <span class="alinear-derecha">Publicado el: ' . $fila['fechaPublicacion'] . '</span>
                </div>
                
                <br>

                <div class="texto ocultar-caja"> ' .$fila['publicacion'] . '</div>
                
                <div class="caja-a-ocultar">
                    <form>
                        <textarea class="caja-para-editar" style="width:100%">s</textarea>
                        <br>
                        <input type="button" value="cambiar" class ="confirmar-cambio">
                    </form>
                </div>

                <div class = "hermanoCodigo">
                    <button class="btn btn-info btn-xs glyphicon glyphicon-thumbs-up meGusta">'. $fila['meGusta'] . '</button>
                    <button class="btn btn-info btn-xs glyphicon glyphicon-thumbs-up noMeGusta">' . $fila['noMeGusta'] . '</button>';
                
           
                if($codigoUsuario == $fila1['codigoUsuario']) {
                    
                    $publicacionApintar .= '
                    <button class="alinear-derecha eliminar btn btn-danger btn-xs glyphicon glyphicon-trash" value="eliminar" ></button>
                    <button class="alinear-derecha editar btn btn-warning btn-xs glyphicon glyphicon-pencil" value="editar"></button>';
                }
            
            $publicacionApintar .= '
                </div>

                <br>

                <div class="box-footer">
                    <!--Publicaciones de publicaciones, es decir seran las publicaciones hechas a mis publicaicones previamente hechas -->
                    <div class = "comentarioAIntroducir">
                    
                        <form action="" method="post">
                            <div class="img-push">
                                <input class="form-control publicarComentario" placeholder="Escribe un comentario" name="envio-publi" />
                                <div><input type="button" class = "enviarComentario btn btn-success btn btn-default btn-xs" value="Comentar"/></div>
                                
                                <div>';
                                                          
                                            $resultado2 = $this->conexion->query("select * from comentarios where codigoPublicacion = '" . $fila['codigoPublicacion'] . "' ORDER BY codigoComentario desc");
                     
                                            while($fila2 = $resultado2->fetch_assoc()) {
                                                
                                                $comentarioFrom = $this->conexion->query("select * from usuarios where codigoUsuario IN (SELECT codigoUsuario from comentarios where codigoUsuario = '" . $fila2['codigoUsuario'] . "') ");
                                                
                                                $datosUsu = $comentarioFrom->fetch_assoc();
                                                
                                                $publicacionApintar .= 
                                                
                                                '<div class = "comentarios">
                                                
                                                <span> <img class = "imagenComentario" src = "' .$datosUsu['imagen'] . '" </img> <b>' .$datosUsu['nombre'] . ' ' .$datosUsu['apellido'] . ' </b> </span>
                                                <span class="alinear-derecha">Publicado el: <b>' . $fila2['fechaComentario'] . '</b></span>
                                                
                                                <div class="introducirComentario"> ' .$fila2['comentario'] . '</div>
                                                                                                                                                
                                                <input type = "hidden" class = "codigoComentario" value = "' . $fila2['codigoComentario'] . '" /> 

                                                
                                                <button class="btn btn-warning btn-xs glyphicon glyphicon-thumbs-up meGustaComen">' . $fila2['meGusta'] . '</button>
                                                <button class="btn btn-warning btn-xs glyphicon glyphicon-thumbs-down noMeGustaComen">' . $fila2['noMeGusta'] . '</button>
                                                
                                                </div>'; 
                                            }
                                      
        $publicacionApintar .= '</div>
                                
                            </div>
                            
                        </form>
                        
                    </div>

                </div>
            </div><br>';
                   
            array_push($devolverArray, $publicacionApintar);
        }
        
        return $devolverArray ;
    }


    
   /**
    * Cambio de la foto de perfil
    *
    * Con esta funcion realizaremos el cambio de la imagen de perfil, para ello con los          parametros recibidos buscaremos en la bbdd la imagen a borrar para posteriormente introducir en la misma columna la imagen nueva. 
    *
    * @param recibimos dos parametros el id del usuario del q se pretendre realizar los cambios y la url de la foto nueva
    **/
    function cambiarImagen($idUsuario, $fotoNueva) {
        
        $fotoCambiar = '';
        //primero averiguar la imagen a cambiar
        $sql = "SELECT * FROM usuarios WHERE codigoUsuario = $idUsuario";
        $consulta = $this->conexion->query($sql);

        if($consulta->num_rows > 0) {
            while ($fila = $consulta->fetch_assoc()) {
                # code...
                $fotoCambiar = $fila['imagen'];
            }
        }

        unlink($fotoCambiar); //Borra la imagen de la carpeta donde esta guardada para poder meter una imagen nueva

        //habria que comprobar previamente que hay foto para cambiar 
        $nombreImagen = $fotoNueva['name'];
        $rutaProvisional = $fotoNueva['tmp_name'];
        $carpeta = "../Imagenes/usuariosRegistrados/";
        $src = '../' . $carpeta . time() .$nombreImagen;

        move_uploaded_file($rutaProvisional, $src); //inserta la nueva imagen en la carpeta

        $sql = "UPDATE usuarios set imagen = '$src' WHERE codigoUsuario = '$idUsuario'" ;
        $consulta = $this->conexion->query($sql);
        
       header('Location: ../muropropio/muropropio.php');
    }

    function datosUsuario($correoUsuario) {
        $sql = "SELECT * FROM usuarios Where correo = '$correoUsuario'";
        $consulta = $this->conexion->query($sql);

        if ($consulta->num_rows > 0) {
            $fila = $consulta->fetch_assoc();

            return $fila;
        }
    }

	function numSolicitudesAmistad($id_usuario) {
		$sql = "SELECT estadoAmistad from amigos WHERE codigoUsuario = '$id_usuario'";
		$consulta = $this->conexion->query($sql);

		return $consulta->num_rows;

	}

	function numeroAmigos($id_usuario) {
		$SQL1 = "select * 
		FROM amigos
		where (codigoUsuario = $id_usuario || codigoAmigo = $id_usuario) 
		AND estadoAmistad = 'T'";
		$consultaFinal = $this->conexion->query($SQL1);
		$resultado1 = $consultaFinal->num_rows;

		return $resultado1;
	}

    function enviarMensajePrivado($codigoOrigen, $codigoDestino,$asunto, $mensaje, $estado) {
        
        $sql = "INSERT INTO  mensajeria VALUES (NULL,'$codigoOrigen', '$codigoDestino', '$asunto', '$mensaje', '$estado')";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }


    function cargarMensajesEnviados($codigoUsuario) {

        $arrayRetorno = array();
        $sql = "SELECT * from mensajeria where emisor= '$codigoUsuario' AND (estado='0' OR estado='2')";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
               array_push($arrayRetorno, $fila);
            }
        }
        
        return $arrayRetorno;
    }

    function cargarMensajesRecibidos($codigoUsuario) {
        
        $arrayRetorno = array();
        $sql = "SELECT * from mensajeria where receptor = '$codigoUsuario' AND (estado='0' OR estado='1')";
        $resultado = $this->conexion->query($sql);
        
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
               array_push($arrayRetorno, $fila);
            }
        }

        return $arrayRetorno;
    }

    function eliminarMensajeEnviado($idMensajeaBorrar) {
        
        $retorno = "";
        $sql = "Select estado from mensajeria where idMensaje = '$idMensajeaBorrar'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            
            if ($fila['estado'] == 0) {
                
                $sql = "Update mensajeria set estado = '1' where idMensaje = '$idMensajeaBorrar'";
                $retorno = $this->conexion->query($sql);
            } else {

                $sql = "delete from mensajeria where idMensaje = '$idMensajeaBorrar'";
                $retorno = $this->conexion->query($sql);
  
            }
        }

        /*if ($retorno) {
            return 'Mensaje eliminado correctamente';
        } else {
            return 'No se ha podido borrar el mensaje';
        }*/
    }

    function eliminarMensajeRecibido($idMensajeaBorrar) {
        $retorno;

        $sql = "Select estado from mensajeria where idMensaje = '$idMensajeaBorrar'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
             
            if ($fila['estado'] == 0) {
                
                $sql = "Update mensajeria set estado = '2' where idMensaje = '$idMensajeaBorrar'";
                $retorno = $this->conexion->query($sql);
            } else {
    
                $sql = "delete from mensajeria where idMensaje = '$idMensajeaBorrar'";
                $retorno = $this->conexion->query($sql);
            }
        }

        /*if ($retorno) {
             
            return 'Mensaje eliminado correctamente';
        } else {
            return 'No se ha podido borrar el mensaje';
        }*/
    }

    function datosMensaje($receptor) {
        $resultado = $this->conexion->query("SELECT nombre,apellido, imagen from usuarios where codigoUsuario = '$receptor'");

        while ($fila = $resultado->fetch_assoc()) {
            return $fila;
        }
        
    }

    function datosMensajeRecibido($emisor) {
        
        $resultado = $this->conexion->query("SELECT nombre,apellido from usuarios where codigoUsuario = '$emisor'");
        $retorno = array();

        while ($fila = $resultado->fetch_assoc()) {

            return $fila;
        }
    }

    function numMensajesEnviados($codigoUsuario) {
        $resultado = $this->conexion->query("SELECT * from mensajeria where emisor = '$codigoUsuario' AND  estado != '1'" );

        return $resultado->num_rows;

    }

    function numMensajesRecibidos($codigoUsuario) {
        $resultado = $this->conexion->query("SELECT * from mensajeria where receptor = '$codigoUsuario' AND estado != '2'");
        return $resultado->num_rows; 
    }
    
    
    function rechazarSolicitud($idUsuRechazar){
        $resultado = $this->conexion->query("delete from amigos where codigoUsuario = '$idUsuRechazar' AND estadoAmistad = 'P'");
        return $resultado;
    }

    function desconectar() {
        $this->conexion->close();
    }
}

if (isset($_POST['cambioFotoPerfil'])) { //id que llega desde el apartado cambiar foto

    $idUsuario = $_POST['id-usuario'];
    $fotoNueva = $_FILES['foto-nueva'];
    $funciones = new FunctionesGenerales();
    $funciones->cambiarImagen($idUsuario, $fotoNueva);
}
?>

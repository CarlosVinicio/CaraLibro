<?php 
Class BaseDatos {
	private $ip = "localhost";
	private $usuario = "root";
	private $contrasenna = "";
	private $nombreBaseDatos = "caralibro";
	private $conexion = "";

	function conectar() {
		$this->conexion = new mysqli($this->ip, $this->usuario, $this->contrasenna, $this->nombreBaseDatos);

		if ( $this->conexion->connect_error ) {
			die("Error de conexión: " . $this->conexion->connect_errno . ", " . $this->conexion->connect_error);
		}
	}

	function insertarPublicacion($id, $publicacion) {
		$fechaPublicacion = date('d/m/Y H:i:s');
		$update = "insert into publicaciones(codigoUsuario, publicacion, fechaPublicacion, meGusta, noMeGusta) values($id, '$publicacion', '$fechaPublicacion', 0, 0)";
		echo $update;
		$query = $this->conexion->query($update);

		if ( $query > 0 ) {
			return true;
		} else {
			return false;
		}
	}

    function aunNoLike($idPublicacion, $codigoUsuario, $deserializado) {
        $meGustaAsignado = 0;
        $arrayDatos = array();
        
        $meGustas = $this->conexion->query("select meGusta from publicaciones where codigoPublicacion = $idPublicacion")->fetch_array()[0];
        $meGustaAsignado = intval($meGustas) + 1;
        $resultado = $this->conexion->query("update publicaciones set meGusta = $meGustaAsignado where codigoPublicacion = $idPublicacion");
        
   
            
            
        if (!empty($deserializado)) {
            for ($i = 0 ; $i <= count($deserializado) -1 ; $i++) {
                array_push($arrayDatos, $deserializado[$i]);
            }
        }
        
        array_push($arrayDatos, $codigoUsuario); 
        
       
        $datosSerializados = serialize($arrayDatos);
         
        $resultado = $this->conexion->query("update publicaciones set likeDadoPor = '$datosSerializados' where codigoPublicacion = $idPublicacion");
        
        return $meGustaAsignado;

    }
    
    function likeYaDado($idPublicacion, $codigoUsuario, $deserializado, $posicionABorrar){
        
        $meGustaAsignado = 0;
        $arrayDatos = array();
    
        $meGustas = $this->conexion->query("select meGusta from publicaciones where codigoPublicacion = $idPublicacion")->fetch_array()[0];
        
       
        if ($meGustas > 0) {
            
            $meGustaAsignado = intval($meGustas) - 1;
            $resultado = $this->conexion->query("update publicaciones set meGusta = $meGustaAsignado where codigoPublicacion = $idPublicacion");
            
            unset($deserializado[$posicionABorrar]);
        
            $arrayDatos = array_values($deserializado);
        
            $datosSerializados = serialize($arrayDatos);
                     
            $resultado = $this->conexion->query("update publicaciones set likeDadoPor = '$datosSerializados' where codigoPublicacion = $idPublicacion");
            
        }
        
        return $meGustaAsignado;
    }
    
    function darMegusta($idPublicacion, $codigoUsuario) {
        
        $sql = "select likeDadoPor from publicaciones where codigoPublicacion = $idPublicacion";
        $resultado = $this->conexion->query($sql);
        $meGustaAsignado = 0;
        
        if ($resultado->num_rows > 0) {
            
            $fila = $resultado->fetch_assoc();
            
            $deserializado = unserialize($fila['likeDadoPor']);
            
            if ($deserializado == false) { // el campos esta vacio inicialmente
                    //return 'esta inicialmente vacio';
                    $meGustaAsignado = $this->aunNoLike($idPublicacion, $codigoUsuario, $deserializado);
                
            } else {
                if (empty($deserializado)) { // si el array deserializado esta vacio 
                
                //return 'el array esta vacio';
                    $meGustaAsignado = $this->aunNoLike($idPublicacion, $codigoUsuario , $deserializado);
                
                } else {  // si el array deserializado no esta vacio
                    
                        $posicionArray = array_search( $codigoUsuario, $deserializado);
                        
                        
                    
                        if ($posicionArray !== false) {
                            
                            $meGustaAsignado = $this->likeYaDado($idPublicacion, $codigoUsuario, $deserializado, $posicionArray);
                        } else {
                           
                            $posicionArray = intval($posicionArray);     
                            $meGustaAsignado = $this->aunNoLike($idPublicacion, $codigoUsuario, $deserializado);
  
                        }
                }
            }
      }  
        
        return $meGustaAsignado;
    }

    
    
     function aunNodislike($idPublicacion, $codigoUsuario, $deserializado) {
        $meGustaAsignado = 0;
        $arrayDatos = array();
        
        $meGustas = $this->conexion->query("select noMeGusta from publicaciones where codigoPublicacion = $idPublicacion")->fetch_array()[0];
        $meGustaAsignado = intval($meGustas) + 1;
        $resultado = $this->conexion->query("update publicaciones set noMeGusta = $meGustaAsignado where codigoPublicacion = $idPublicacion");
   
        if (!empty($deserializado)) {
            for ($i = 0 ; $i <= count($deserializado) -1 ; $i++) {
                array_push($arrayDatos, $deserializado[$i]);
            }
        }
        
        array_push($arrayDatos, $codigoUsuario); 
        $datosSerializados = serialize($arrayDatos);
         
        $resultado = $this->conexion->query("update publicaciones set dislikeDadoPor = '$datosSerializados' where codigoPublicacion = $idPublicacion");
        
        return $meGustaAsignado;

    }
    
    function dislikeYaDado($idPublicacion, $codigoUsuario, $deserializado, $posicionABorrar){
        
        $meGustaAsignado = 0;
        $arrayDatos = array();
    
        $meGustas = $this->conexion->query("select noMeGusta from publicaciones where codigoPublicacion = $idPublicacion")->fetch_array()[0];
        
       
        if ($meGustas > 0) {
            
            $meGustaAsignado = intval($meGustas) - 1;
            $resultado = $this->conexion->query("update publicaciones set noMeGusta = $meGustaAsignado where codigoPublicacion = $idPublicacion");
            
            unset($deserializado[$posicionABorrar]);
        
            $arrayDatos = array_values($deserializado);
        
            $datosSerializados = serialize($arrayDatos);
                     
            $resultado = $this->conexion->query("update publicaciones set dislikeDadoPor = '$datosSerializados' where codigoPublicacion = $idPublicacion");
            
        }
        
        
        
        
        return $meGustaAsignado;
    }
    
    
    function darNoMeGusta($idPublicacion, $codigoUsuario) {
        
        $sql = "select dislikeDadoPor from publicaciones where codigoPublicacion = $idPublicacion";
        $resultado = $this->conexion->query($sql);
        $meGustaAsignado = 0;
        
        if ($resultado->num_rows > 0) {
            
            $fila = $resultado->fetch_assoc();
            
            $deserializado = unserialize($fila['dislikeDadoPor']);
            
            if ($deserializado == false) { // el campos esta vacio inicialmente
                    //return 'esta inicialmente vacio';
                    $meGustaAsignado = $this->aunNodislike($idPublicacion, $codigoUsuario, $deserializado);
                
            } else {
                if (empty($deserializado)) { // si el array deserializado esta vacio 
                    $meGustaAsignado = $this->aunNodislike($idPublicacion, $codigoUsuario , $deserializado);
                
                } else {  // si el array deserializado no esta vacio
                    
                        $posicionArray = array_search( $codigoUsuario, $deserializado);
                        
                        if ($posicionArray !== false) {
                            
                            $meGustaAsignado = $this->dislikeYaDado($idPublicacion, $codigoUsuario, $deserializado, $posicionArray);
                        } else {
                           
                            $posicionArray = intval($posicionArray);     
                            $meGustaAsignado = $this->aunNodislike($idPublicacion, $codigoUsuario, $deserializado);
  
                        }
                }
            }
      }  
        
        return $meGustaAsignado;
    }
    
    
    
    function insertarComentario($id, $comentario, $codigoUsuario) {
        $fechaComentario = date('d/m/Y H:i:s');
        $update = "insert into comentarios(codigoUsuario,codigoPublicacion, comentario, fechaComentario, meGusta, noMeGusta) values($codigoUsuario,$id, '$comentario', '$fechaComentario', 0, 0)";
        $query = $this->conexion->query($update);
        
        return $query;
 
        if ( $query > 0 ) {
            return true;
        } else {
            return false;
        }
    }
    
    
    function modificarPublicacion($idPublicacion, $cuerpo) {
        $query = $this->conexion->query("update publicaciones set publicacion = '$cuerpo' where codigoPublicacion = $idPublicacion");
 
        if ( $query > 0 ) {
            return true;
        } else {
            return false;
        }
    }
 
    function eliminarPublicacion($idPublicacion) {
        $query = $this->conexion->query("delete from publicaciones where codigoPublicacion = $idPublicacion");
        
        $query = $this->conexion->query("delete from comentarios where codigoPublicacion = $idPublicacion");

 
        if ( $query->num_rows > 0 ) {
            return true;
        } else {
            return false;
        }
    }
    
    function desconectar() {
          $this->conexion->close();
    }
}



?>
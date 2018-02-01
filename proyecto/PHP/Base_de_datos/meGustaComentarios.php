
    
<?php
class BaseDatos {

    private $conexion;
    
    function __construct() {
        
        $this->conexion = new mysqli('localhost', "root", "", "caralibro");

    }
    
    
    function aunNodisLike($idComentario, $codigoUsuario, $deserializado) {
        $meGustaAsignado = 0;
        $arrayDatos = array();
        
        $meGustas = $this->conexion->query("select noMeGusta from comentarios where codigoComentario = $idComentario")->fetch_array()[0];
        $meGustaAsignado = intval($meGustas) + 1;
        $resultado = $this->conexion->query("update comentarios set noMeGusta = $meGustaAsignado where codigoComentario = $idComentario");
   
        if (!empty($deserializado)) {
            for ($i = 0 ; $i <= count($deserializado) -1 ; $i++) {
                array_push($arrayDatos, $deserializado[$i]);
            }
        }
        
        array_push($arrayDatos, $codigoUsuario); 
        $datosSerializados = serialize($arrayDatos);
         
        $resultado = $this->conexion->query("update comentarios set dislikeDadoPor = '$datosSerializados' where codigoComentario = $idComentario");
        
        return $meGustaAsignado;

    }
    
    function dislikeYaDado($idComentario, $codigoUsuario, $deserializado, $posicionABorrar){
        
        $meGustaAsignado = 0;
        $arrayDatos = array();
    
        $meGustas = $this->conexion->query("select noMeGusta from comentarios where codigoComentario = $idComentario")->fetch_array()[0];
        
       
        if ($meGustas > 0) {
            
            $meGustaAsignado = intval($meGustas) - 1;
            $resultado = $this->conexion->query("update comentarios set noMeGusta = $meGustaAsignado where codigoComentario = $idComentario");
            
            unset($deserializado[$posicionABorrar]);
        
            $arrayDatos = array_values($deserializado);
        
            $datosSerializados = serialize($arrayDatos);
                     
            $resultado = $this->conexion->query("update comentarios set dislikeDadoPor = '$datosSerializados' where codigoComentario = $idComentario");
            
        }
        
        return $meGustaAsignado;
    }
    
    
    function darNoMeGustaComentario($idComentario, $codigoUsuario) {
        
        
        $sql = "select dislikeDadoPor from comentarios where codigoComentario = $idComentario";
        $resultado = $this->conexion->query($sql);
        $meGustaAsignado = 0;
        
        if ($resultado->num_rows > 0) {
            
            $fila = $resultado->fetch_assoc();
            $deserializado = unserialize($fila['dislikeDadoPor']);
            
            if ($deserializado == false) { // el campos esta vacio inicialmente
                    //return 'esta inicialmente vacio';
                    $meGustaAsignado = $this->aunNodisLike($idComentario, $codigoUsuario, $deserializado);
                
            } else {
                if (empty($deserializado)) { // si el array deserializado esta vacio 
                    $meGustaAsignado = $this->aunNodisLike($idComentario, $codigoUsuario , $deserializado);
                
                } else {  // si el array deserializado no esta vacio
                        $posicionArray = array_search( $codigoUsuario, $deserializado);
                        
                        if ($posicionArray !== false) { 
                            $meGustaAsignado = $this->dislikeYaDado($idComentario, $codigoUsuario, $deserializado, $posicionArray);
                        } else {
                            $posicionArray = intval($posicionArray);     
                            $meGustaAsignado = $this->aunNodisLike($idComentario, $codigoUsuario, $deserializado);
                        }
                }
            }
      }  
        
        return $meGustaAsignado;
    }
    
    
    
    function aunNoLike($idComentario, $codigoUsuario, $deserializado) {
        $meGustaAsignado = 0;
        $arrayDatos = array();
        
        $meGustas = $this->conexion->query("select meGusta from comentarios where codigoComentario = $idComentario")->fetch_array()[0];
        $meGustaAsignado = intval($meGustas) + 1;
        $resultado = $this->conexion->query("update comentarios set meGusta = $meGustaAsignado where codigoComentario = $idComentario");
   
        if (!empty($deserializado)) {
            for ($i = 0 ; $i <= count($deserializado) -1 ; $i++) {
                array_push($arrayDatos, $deserializado[$i]);
            }
        }
        
        array_push($arrayDatos, $codigoUsuario); 
        $datosSerializados = serialize($arrayDatos);
         
        $resultado = $this->conexion->query("update comentarios set likeDadoPor = '$datosSerializados' where codigoComentario = $idComentario");
        
        return $meGustaAsignado;

    }
    
    function likeYaDado($idComentario, $codigoUsuario, $deserializado, $posicionABorrar){
        
        $meGustaAsignado = 0;
        $arrayDatos = array();
    
        $meGustas = $this->conexion->query("select meGusta from comentarios where codigoComentario = $idComentario")->fetch_array()[0];
        
       
        if ($meGustas > 0) {
            
            $meGustaAsignado = intval($meGustas) - 1;
            $resultado = $this->conexion->query("update comentarios set meGusta = $meGustaAsignado where codigoComentario = $idComentario");
            
            unset($deserializado[$posicionABorrar]);
        
            $arrayDatos = array_values($deserializado);
        
            $datosSerializados = serialize($arrayDatos);
                     
            $resultado = $this->conexion->query("update comentarios set likeDadoPor = '$datosSerializados' where codigoComentario = $idComentario");
            
        }
        
        
        
        return $meGustaAsignado;
    }
    
    
    
    function darMeGustaComentario($idComentario, $codigoUsuario) {
        
        $sql = "select likeDadoPor from comentarios where codigoComentario = $idComentario";
        $resultado = $this->conexion->query($sql);
        $meGustaAsignado = 0;
        
        if ($resultado->num_rows > 0) {
            
            $fila = $resultado->fetch_assoc();
            $deserializado = unserialize($fila['likeDadoPor']);
            
            if ($deserializado == false) { // el campos esta vacio inicialmente
                    //return 'esta inicialmente vacio';
                    $meGustaAsignado = $this->aunNoLike($idComentario, $codigoUsuario, $deserializado);
                
            } else {
                if (empty($deserializado)) { // si el array deserializado esta vacio 
                    $meGustaAsignado = $this->aunNoLike($idComentario, $codigoUsuario , $deserializado);
                
                } else {  // si el array deserializado no esta vacio
                        $posicionArray = array_search( $codigoUsuario, $deserializado);
                        
                        if ($posicionArray !== false) { 
                            $meGustaAsignado = $this->likeYaDado($idComentario, $codigoUsuario, $deserializado, $posicionArray);
                        } else {
                            $posicionArray = intval($posicionArray);     
                            $meGustaAsignado = $this->aunNoLike($idComentario, $codigoUsuario, $deserializado);
                        }
                }
            }
      }  
        
        return $meGustaAsignado;
    }
    
    
    function desconectar() {
        $this->conexion->close();
    }
}
?>
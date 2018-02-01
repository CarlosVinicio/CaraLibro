<?php
class BaseDatos {
	private $conexion;
	private $consulta;
	private $resultado;
	function conectar($servidor,$usuario,$contrasenna,$base){
		$this->conexion = new mysqli($servidor,$usuario,$contrasenna,$base);
		if($this->conexion->connect_error){
			die('Error de Conexión('.$this->conexion->connect_errno.')'.$this->conexion->connect_error);
		} 
	}
    
	function obtenerImagen($codigo){
        
        $codigo = intval($codigo);
		$this->consulta = "select imagen from usuarios where codigoUsuario = $codigo ";
		$this->resultado = $this->conexion->query($this->consulta);
        
		$datos = $this->resultado->fetch_array(MYSQLI_NUM);
		if($datos > 0){
			return $datos[0];
		}else{
			return("No se puede obtener la foto");
		}
	}
    
	function obtenerDatos($codigo){
		$this->consulta = "select nombre, apellido, fechaNacimiento, sexo from usuarios where codigoUsuario = $codigo";
		$this->resultado = $this->conexion->query($this->consulta);
		$fila = $this->resultado->fetch_array(MYSQLI_NUM);
		if($fila > 0){
			return json_encode($fila);
		}else{

			return("No se pueden visualizar los datos");
		}
	}
    
	function obtenerPublicaciones($codigo){
		$this->consulta = "select * from publicaciones where codigoUsuario = $codigo order by codigoPublicacion desc";
		$this->resultado = $this->conexion->query($this->consulta);
		$arrayPublicaciones = array();
		if($this->resultado->num_rows > 0){
			while($fila = $this->resultado->fetch_array(MYSQLI_NUM)){
				array_push($arrayPublicaciones, $fila);
			}
			return($arrayPublicaciones);
		}else{
			return(false);
		}
	}
	function obtenerComentarios($codigoPublicacion){
		$this->consulta = "select * from comentarios where codigoPublicacion = $codigoPublicacion order by codigoComentario desc";
		$this->resultado = $this->conexion->query($this->consulta);
		$arrayComentarios = array();
		if($this->resultado->num_rows > 0){
			while($fila = $this->resultado->fetch_array(MYSQLI_NUM)){
				array_push($arrayComentarios, $fila);
			}
			return($arrayComentarios);
		}else{
			return(false);
		}
	}

	function obtenerDatosComentario($codigoAmigo){
		$this->consulta = "select nombre, apellido, imagen from usuarios where codigoUsuario = $codigoAmigo";
		$this->resultado = $this->conexion->query($this->consulta);
		$amigo = $this->resultado->fetch_array(MYSQLI_NUM);
		if($amigo > 0){
			return $amigo;
		}else{
			return("No se pueden visualizar los datos");
		}
	}
}
?>
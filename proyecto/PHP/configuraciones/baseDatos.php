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
	function modificarDatos($campo,$valorNuevo, $codigo){
		session_start();

		$_SESSION[$campo] = $valorNuevo;

		$this->consulta = "update usuarios set $campo = '$valorNuevo' where codigoUsuario = $codigo";

		if($this->resultado = $this->conexion->query($this->consulta)){
			//echo("Usuario modificado");
		}else{
			//echo("Usuario no modificado");
		}
	}
	function visualizarDatos($codigo){
		$this->consulta = "select nombre,apellido,fechaNacimiento,sexo from usuarios where codigoUsuario = $codigo";
		$this->resultado = $this->conexion->query($this->consulta);
		$fila = $this->resultado->fetch_array(MYSQLI_NUM);
		if($fila > 0){
			echo json_encode($fila);
		}else{
			echo("No se pueden visualizar los datos");
		}
	}

	//-------- modificado carlos Cambie los echos por returns ----------------
	function obtenerContrasenna($codigo){
		$this->consulta = "select contrasena from usuarios where codigoUsuario = $codigo";
		$this->resultado = $this->conexion->query($this->consulta);
		$datos = $this->resultado->fetch_array(MYSQLI_NUM);
		if($datos > 0){
			return $datos[0];
		}else{
			return ("No se puede obtener la contraseña");
		}
	}
	//-------- modificado María Cambie los echos por returns ----------------
	function obtenerCorreo($codigo){
		$this->consulta = "select correo from usuarios where codigoUsuario = $codigo";
		$this->resultado = $this->conexion->query($this->consulta);
		$datos = $this->resultado->fetch_array(MYSQLI_NUM);
		if($datos > 0){
			return $datos[0];
		}else{
			return("No se puede obtener el correo");
		}
	}
	//-------- modificado María Cambie los echos por returns y la funcion entera----------------
	function comprobarCorreo($correo){
		$this->consulta = "select correo from usuarios where correo = '$correo'";
		$this->resultado = $this->conexion->query($this->consulta);
		if($this->resultado->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
}
?>
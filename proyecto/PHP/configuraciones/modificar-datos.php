<?php
session_start();
$codigo = $_SESSION['codigoUsuario'];

include "baseDatos.php";
$campos = array("nombre","apellido","fechaNacimiento","sexo","imagen");
$arrayDatos = json_decode($_GET['datos']);
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');

for ($v = 0; $v < count($arrayDatos); $v++) {
	if($arrayDatos[$v] != ""){
		$fotoAntigua = "";
		if($v == 4){
			$fotoAntigua = $baseDatos->obtenerImagen($codigo);
			unlink($fotoAntigua);
			$imagen = $arrayDatos[$v]['name'];
			$url = $arrayDatos[$v]['tmp_name'];
			$destino = "../../Imagenes/usuariosRegistrados/".time().$imagen;
			move_uploaded_file($url,$destino);
			$baseDatos->modificarDatos("imagen",$destino,$codigo);
		}else{


			$baseDatos->modificarDatos($campos[$v],$arrayDatos[$v],$codigo);
		}
	}
}
?>
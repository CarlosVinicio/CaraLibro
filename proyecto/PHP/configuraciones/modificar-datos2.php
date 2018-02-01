<?php
session_start();

$codigo = $_SESSION['codigoUsuario'];
include "baseDatos.php";
$campos = array("correo","contrasena");
$arrayDatos = json_decode($_GET['datos']);
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');

for ($v = 0; $v < count($arrayDatos); $v++) {
	if($arrayDatos[$v] != ""){
		if ($v == 1) {
			$contrasenna = MD5($arrayDatos[$v]);

			$baseDatos->modificarDatos($campos[$v],$contrasenna,$codigo);
			
		}else{
			$baseDatos->modificarDatos($campos[$v],$arrayDatos[$v],$codigo);
		}
	}
}
?>
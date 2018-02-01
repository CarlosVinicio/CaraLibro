<?php
session_start();

include "baseDatos.php";
$codigo = $_SESSION['codigoUsuario'];
$contrasennaActual = $_REQUEST['contrasenna'];


$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$contrasenna = $baseDatos->obtenerContrasenna($codigo);

if(md5($contrasennaActual) == $contrasenna){
	echo true;
}else{
	echo false;
}
?>
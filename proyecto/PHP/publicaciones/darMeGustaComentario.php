<?php 
session_start();

@include "../Base_de_datos/meGustaComentarios.php";

$idComentario = $_REQUEST["idComentario"];


$bbdd = new BaseDatos();
$resultado = $bbdd->darMeGustaComentario($idComentario, $_SESSION['codigoUsuario']);
$bbdd->desconectar();
echo $resultado;
?>
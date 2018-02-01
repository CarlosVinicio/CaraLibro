<?php 
session_start();

@include "../Base_de_datos/bbdd_publicaciones.php";

$comentario = $_REQUEST["comentario"];
$idPublicacion = $_REQUEST['idPublicacion'];
$codigoUsuario = $_SESSION['codigoUsuario'];


$bbdd = new BaseDatos();
$bbdd->conectar();
$resultado = $bbdd->insertarComentario($idPublicacion, $comentario, $codigoUsuario);
$bbdd->desconectar();
echo $resultado;
?>
<?php 
session_start();

@include "../Base_de_datos/bbdd_publicaciones.php";

$idPublicacion = $_REQUEST["idPublicacion"];

$bbdd = new BaseDatos();
$bbdd->conectar();
$resultado = $bbdd->eliminarPublicacion($idPublicacion);
$bbdd->desconectar();
echo $resultado;
?>
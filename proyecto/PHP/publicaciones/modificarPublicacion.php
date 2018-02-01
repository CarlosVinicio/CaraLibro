<?php 
session_start();

@include "../Base_de_datos/bbdd_publicaciones.php";

$idPublicacion = $_REQUEST["idPublicacion"];
$cuerpo = $_REQUEST["cuerpo"];


$bbdd = new BaseDatos();
$bbdd->conectar();
$resultado = $bbdd->modificarPublicacion($idPublicacion, $cuerpo);
$bbdd->desconectar();
echo $resultado;
?>
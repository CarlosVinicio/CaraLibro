<?php 
session_start();

@include "../Base_de_datos/bbdd_publicaciones.php";

$publicacion = $_REQUEST["publicacion"];
$idUsuario = $_SESSION["codigoUsuario"];


echo $publicacion;
echo $idUsuario;


$bbdd = new BaseDatos();
$bbdd->conectar();
$resultado = $bbdd->insertarPublicacion($idUsuario, $publicacion);
$bbdd->desconectar();

echo $resultado;
?>
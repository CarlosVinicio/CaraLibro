<?php 
session_start();

@include "../Base_de_datos/bbdd_publicaciones.php";

$idPublicacion = $_REQUEST["idPublicacion"];



$bbdd = new BaseDatos();
$bbdd->conectar();
//$resultado = $bbdd->darMeGusta($idPublicacion);
$resultado = $bbdd->darMeGusta($idPublicacion, $_SESSION['codigoUsuario']);

$bbdd->desconectar();

echo $resultado;

?>
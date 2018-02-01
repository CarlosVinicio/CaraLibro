<?php 
session_start();

@include "../Base_de_datos/funcionesGenerales.php";

$bbdd = new FuncionesGenerales();
$bbdd->conectar();
$resultado = $bbdd->cargarPublicaciones($_SESSION['codigoUsuario']);

echo $resultado;
?>
<?php 

session_start();
@include "../Base_de_datos/bbdd_redes.php";

$idUsuario = $_SESSION["codigoUsuario"];

$amigos = new RedAmigos();
$amigos->conectar();

$resultados = $amigos->visualizarAmigos($idUsuario);
$amigos->desconectar();

echo json_encode($resultados)


?>
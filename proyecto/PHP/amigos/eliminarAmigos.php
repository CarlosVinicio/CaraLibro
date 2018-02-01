<?php
session_start();
@include "../Base_de_datos/bbdd_redes.php";

$codigoUsuarioOrigen = $_SESSION['codigoUsuario'];
$codigoUsuarioDestino = $_REQUEST["usuarioDestino"];


$coincidencias = new RedAmigos();
$coincidencias->conectar();
$respuesta = $coincidencias->eliminarAmigo($codigoUsuarioOrigen, $codigoUsuarioDestino);
$coincidencias->desconectar();

echo var_dump($respuesta);

?>
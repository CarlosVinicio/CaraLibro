<?php 

session_start();

@include "../Base_de_datos/bbdd_redes.php";


$codigoUsuarioOrigen = $_SESSION['codigoUsuario'];
$codigoUsuarioDestino = $_REQUEST["receptor"];


$coincidencias = new RedAmigos();
$coincidencias->conectar();
$estadoPeticionAmistad = $coincidencias->agregarAmigo($codigoUsuarioOrigen, $codigoUsuarioDestino);
$coincidencias->desconectar();
echo $estadoPeticionAmistad;
?>
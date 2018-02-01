<?php 
session_start();

 @include "../Base_de_datos/bbdd_redes.php";

//Cambie los valores de primer usuario por el del segundo y viceversa. ya que sino nunca podrian hacerse amigos no coincidian los id en la base de datos.
$primerUsuario =  $_REQUEST["segundoUsuario"];
$segundoUsuario = $_SESSION['codigoUsuario'];


$confimarPeticion = new RedAmigos();
$confimarPeticion->conectar();
$resultadoConfirmacion = $confimarPeticion->aceptarSolicitud($primerUsuario, $segundoUsuario);

echo json_encode($resultadoConfirmacion);
?>
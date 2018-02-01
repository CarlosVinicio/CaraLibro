<?php 

session_start();

@include "../Base_de_datos/bbdd_redes.php";

$idUsuario = $_SESSION['codigoUsuario'];

$solicitudes = new RedAmigos();
$solicitudes->conectar();
$resultados = $solicitudes->comprobarSolicitudes($idUsuario);
$solicitudes->desconectar();
echo json_encode($resultados);
?>
<?php 
@include "Base_de_datos/bbdd_redes.php";

$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$codigoUsuario = $_REQUEST['codigoUsuario'];

$coincidencias = new RedAmigos();
$coincidencias->conectar();
$usuariosEncontrados = $coincidencias->visualizarCoincidencias($nombre, $apellidos, $codigoUsuario);
$coincidencias->desconectar();

echo json_encode($usuariosEncontrados);

?>
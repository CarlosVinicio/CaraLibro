<?php
session_start();
include "../Base_de_datos/baseDatos.php";

$codigo = $_SESSION['codigoUsuario'];
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$datos = $baseDatos->obtenerDatos($codigo);
echo($datos)
?>
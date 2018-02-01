<?php
session_start();

include "baseDatos.php";
$codigo = $_SESSION['codigoUsuario'];
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$datos = $baseDatos->obtenerCorreo($codigo);
echo $datos;
?>
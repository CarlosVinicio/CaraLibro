<?php

session_start();
include "../Base_de_datos/baseDatos.php";

$codigo = $_SESSION['codigoUsuario'];


$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$imagen = $baseDatos->obtenerImagen($codigo);

echo $imagen;
//echo($imagen);
?>
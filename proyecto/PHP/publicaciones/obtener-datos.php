<?php
include "../Base_de_datos/baseDatos.php";



$codigo = $_GET['idAmigo'];
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$datos = $baseDatos->obtenerDatos($codigo);
echo($datos)
?>
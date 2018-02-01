<?php
session_start();
include "baseDatos.php";
$correo = $_REQUEST['correo'];
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$encontrado = $baseDatos->comprobarCorreo($correo);
echo $encontrado;
?>
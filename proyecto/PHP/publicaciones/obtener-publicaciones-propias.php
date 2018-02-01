<?php
session_start();
include "../Base_de_datos/baseDatos.php";


$codigo = $_SESSION['codigoUsuario'];
$baseDatos = new BaseDatos();
$baseDatos->conectar('localhost','root','','caralibro');
$datos = $baseDatos->obtenerPublicaciones($codigo);
if($datos != false){
	for ($i=0; $i < count($datos); $i++) {
		$comentarios = $baseDatos->obtenerComentarios($datos[$i][0]);
		if($comentarios != false){
			for($m=0; $m < count($comentarios); $m++){
				$datosComentario = $baseDatos->obtenerDatosComentario($comentarios[$m][1]);
				$comentarios[$m][9] = $datosComentario;
			}
		}
		$datos[$i][6] = $comentarios;
	}
	echo(json_encode($datos));
}else{
	echo(json_encode(false));
}

?>
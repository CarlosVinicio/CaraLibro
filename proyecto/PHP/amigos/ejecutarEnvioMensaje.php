<?php

    session_start();
    @include "../Base_de_datos/funcionesGenerales.php";

    $codigoOrigen = $_SESSION['codigoUsuario'];
    $codigoDestino = $_REQUEST['codigoDestino'];
    $mensajeEnviar = $_REQUEST['mensajeEnviar'];
    $asunto = $_REQUEST['asunto'];
    $estado = 0;

    $respuesta = false;
    /*$mensajes = new FunctionesGenerales();
    $respuesta = $mensajes->enviarMensajePrivado($codigoOrigen, $codigoDestino, $asunto,$mensajeEnviar,$estado);
    $mensajes->desconectar();*/


   if ($mensajeEnviar != "" && $asunto != "" ) {
       $mensajes = new FunctionesGenerales();
        $respuesta = $mensajes->enviarMensajePrivado($codigoOrigen, $codigoDestino, $asunto,$mensajeEnviar,$estado);
        $mensajes->desconectar();
   } 

    if ($respuesta) {
        echo 'El mensaje se envio correctamente';
    } else {
        echo 'Error: El envio del mensaje no se pudo realizar';
    }
?>
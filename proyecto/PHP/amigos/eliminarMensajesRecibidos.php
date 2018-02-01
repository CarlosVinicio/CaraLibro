<?php

    session_start();
    @include "../Base_de_datos/funcionesGenerales.php";

    $codigoUsuario = $_SESSION['codigoUsuario'];

    
    if(isset($_REQUEST['idMensajeaBorrar'])) {
        
        $mensajes = new FunctionesGenerales();
        $mensajes->eliminarMensajeRecibido($_REQUEST['idMensajeaBorrar']);

        header('Location: paginaMensajesRecibidos.php');
        
    } 
?>
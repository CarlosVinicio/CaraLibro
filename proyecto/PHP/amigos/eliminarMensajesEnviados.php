<?php

    session_start();
    @include "../Base_de_datos/funcionesGenerales.php";

    if(isset($_REQUEST['idMensajeaBorrar'])) {
        
        $mensajes = new FunctionesGenerales();
        $mensajes->eliminarMensajeEnviado($_REQUEST['idMensajeaBorrar']);

        header('Location: paginaMensajesEnviados.php');
    } 
?>
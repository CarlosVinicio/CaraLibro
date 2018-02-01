<?php

   session_start();
    @include "../Base_de_datos/funcionesGenerales.php";
    echo $_REQUEST['idUsuRechazar'];
    $mensajes = new FunctionesGenerales();
    $resultado = $mensajes->rechazarSolicitud($_REQUEST['idUsuRechazar']);

    echo var_dump($resultado);
?>

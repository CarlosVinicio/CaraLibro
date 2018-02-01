<?php

     session_start(); 
    @include "../Base_de_datos/funcionesGenerales.php";

    $mensajes = new FunctionesGenerales();
    $bandejaEntrada = $mensajes->cargarMensajesRecibidos($_SESSION['codigoUsuario']);


    $datosMensaje;
    $arrayDatos = array();
    
    for ($i=0; $i < count($bandejaEntrada); $i++) { 
        

         $datosMensaje = $mensajes->datosMensajeRecibido($bandejaEntrada[$i]['emisor'] );
         array_push($arrayDatos, $datosMensaje);
    }
    
    
    
    $mensajes->desconectar();
    $codigoUsuario = $_SESSION['codigoUsuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script src="../../JavaScript/jquery-1.12.3.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
    <script src="../../JavaScript/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    <script src="../../JavaScript/busqueda.js"></script>
    <script src="../../JavaScript/cajaEditarComentario.js"></script>
    <script src="../../JavaScript/comprobarSolicitudes.js"></script>
    <script src="../../JavaScript/mostrarAmigos.js"></script>

    <script src="../../JavaScript/jquery-1.12.3.min.js"></script>
    <script src="../../JavaScript/sendEmail.js"></script>
    <script src="../../JavaScript/movimiento.js"></script>

    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/amigos.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../principal/principal.php">Inicio</a>
            </div>

            <!-- formulario que realizara la busqueda de amigos -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" id="nombreUsuarioBuscar" class="form-control" placeholder="nombre">
                    </div>

                    <div class="form-group">
                        <input type="text" id="apellidosUsuarioBuscar" class="form-control" placeholder="apellidos">
                    </div>
                    <input type="hidden" id="codigoUsuario" value="<?php echo $codigoUsuario ?>">
                    <button type="button" class="btn btn-default" id="buscarUsuario">Buscar</button>
                </form>

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notificaciones<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="glyphicon glyphicon-pencil comprobarPublicaciones"></a>
                            </li>
                            <!--comprobar si hay publicaciones-->
                            <li>
                                <a class="glyphicon glyphicon-bell comprobarSolicitudes"></a>
                            </li>
                            <!--comprobar solicitudes de amistad-->
                        </ul>
                    </li>


                    <li><a href="../muropropio/muropropio.php">Perfil</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../configuraciones/configuracion.php">Configuracion perfil</a></li>
                            <li><a href="../configuraciones/configPrivacidad.php">editar privacidad</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../desconectar.php">Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <?php
    
    
        $html = "";

        $html .= '<div class="list-content"><ul class="list-group"><li href="#" class="list-group-item title">Mensajes recibidos</li>';
                           
				for ($i = 0; $i < count($bandejaEntrada); $i++) {
					$html .= '<li href="#" class="list-group-item text-left mensajeMostrado">'; 
                    
                        $html .= "<div class = 'barraMostrada'> ";
                        
                             $html .= "<span class = 'glyphicon glyphicon-plus pull-right mostrarCaja'> </span><div  class='asunto'  > <b>Remitente:</b> " . $arrayDatos[$i]['nombre'] .' ' .$arrayDatos[$i]['apellido'] . "</div>";
                    
                        
                        $html .= "</div>";
                
                    $html .= '<div class = "cajaMostrada cajaMostradaOculta">'; 
                    
                        $html .= "<div  class='asunto'  > <span class = 'text-success'>ASUNTO:</span> " . $bandejaEntrada[$i]['asunto'] . "</div><br>";
                        $html .= "<div  class='asunto'  > <span class = 'text-success'>MENSAJE:</span></div>";
                        $html .= "<div class='mensaje'>" . $bandejaEntrada[$i]['mensaje'] . "</div>";
                        $html .= 	'<br><a class="btn btn-danger btn-xs glyphicon glyphicon-trash eliminarMensaje" href = "../amigos/eliminarMensajesEnviados.php?idMensajeaBorrar= ' . $bandejaEntrada[$i]['idMensaje'] . ' ""></a>';
                    
                    $html .= '</div>';
                    $html .= '<div class="break"></div>';     
                	$html .= '</li>';
				}   
				    $html .= '</ul></div>';    
               
    ?>


    <div id="contenedorPublicaciones">
        <?php echo $html; ?>
    </div>
    </body>


</html>
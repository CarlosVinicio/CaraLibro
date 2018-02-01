
<?php 
    if (isset($_GET['usuarioDestino'])) {
        # code...
        session_start();     

        $codigoDestino = $_GET['usuarioDestino'];
        $nombreApe  = $_GET['nombreApe'];
        
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
    
    <script src="../../JavaScript/busqueda.js"></script>
    <script src="../../JavaScript/cajaEditarComentario.js"></script>
    <script src="../../JavaScript/comprobarSolicitudes.js"></script>
    <script src="../../JavaScript/mostrarAmigos.js"></script>
    <script src="../../JavaScript/jquery-1.12.3.min.js"></script>
    <script src="../../JavaScript/sendEmail.js"></script>


    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/amigos.css">
     <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    

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
                                <a class="glyphicon glyphicon-bell comprobarSolicitudes"></a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="../muropropio/muropropio.php">Perfil</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../configuraciones/configuracion.html">Configuracion perfil</a></li>
                            <li><a href="../configuraciones/configPrivacidad.html">editar privacidad</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../desconectar.php">Cerrar sesion</a></li>
                        </ul>
                    </li>

                    <li><a href="#" class="glyphicon glyphicon-user"><?php echo " Conectado: " . $_SESSION['correo']?></a></li>
                </ul>
            </div>

        </div>
    </nav>

    <div id="contenedorPublicaciones" class="contenedor-publicaciones2">
 
        <form class="form-horizontal">
            <fieldset>

                <legend>Enviar mensaje a: <?php echo $nombreApe ?></legend>
                <input type="hidden" id ="codigoDestino" value="<?php echo $codigoDestino ?>">
                
                <!-- Textarea -->
                <div class="form-group">
                  

                    <label class="col-md-2 control-label"></label>
                    <div class="col-md-8">
                        <input type="text" class= "form-control"id="asunto" placeholder ="asunto" required><br>
                        <textarea class="form-control" id="mensajeEnviar" required></textarea>
                    </div>

                    
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="privateMail"></label>
                    <div class="col-md-7">
                        <button type = "button" id="privateMail"  class="btn btn-success ">Enviar mensaje</button>
                        <button type="reset" id="RESET"  class="btn btn-danger">Borrar</button>
                    </div>
                </div>


            </fieldset>
            <!-- Esto mostrara los errores o si el mensaje ha sido enviado correctamente-->
            <label class="col-md-2"></label>
            <div id="comprobarEnvio" class="col-md-8">
                
            </div>
            
        </form>
    </div>

</body>

</html>

<?php

    } else {
        header('Location: ../muropropio.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script src="../../JavaScript/jquery-1.12.3.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
    <script src="../../JavaScript/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    <script src="../../JavaScript/busqueda.js"></script>
    <script src="../../JavaScript/cajaEditarComentario.js"></script>
    <script src="../../JavaScript/comprobarSolicitudes.js"></script>
    <script src="../../JavaScript/mostrarAmigos.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />
    <script src="../../JavaScript/configuracionPersonal.js"></script>




</head>

<body>

    <?php 
        session_start();

        include '../Base_de_datos/funcionesGenerales.php';

        if (isset($_SESSION['correo'])) { // esto sera funcional cuando la sesion del usuario ya este implementada
            $datosUsuario = new FunctionesGenerales();

            $imagenUsuario = $datosUsuario->cargarImagenPerfil($_SESSION['codigoUsuario']);
			$numeroAmigos = $datosUsuario->numeroAmigos($_SESSION['codigoUsuario']);
            $codigoUsuario = $_SESSION['codigoUsuario'];
			
            
    ?>


    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
                      
                            <!--comprobar si hay publicaciones-->
                            <li>
                                <a class="glyphicon glyphicon-bell comprobarSolicitudes"></a>
                            </li>
                            <!--comprobar solicitudes de amistad-->
                        </ul>
                    </li>

                    <!--<li><a  class="glyphicon glyphicon-bell comprobarPublicaciones">1</a></li> <!--comprobar solicitudes de amistad-->
                    <!--<li><a  class="glyphicon glyphicon-bell comprobarSolicitudes">1</a></li> <!--comprobar solicitudes de amistad-->

                    <li><a href="../muroPropio/muroPropio.php">Perfil</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../configuraciones/configuracion.php">Configuracion perfil</a></li>
                            <li><a href="../configuraciones/configPrivacidad.php">editar privacidad</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../desconectar.php">Cerrar sesion</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="glyphicon glyphicon-user">
                            <?php echo " Conectado: " . $_SESSION['correo']?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>



    <div class="actualizar-perfil" id="contenedorPublicaciones">
        <h3 class="text-success">Modificar datos</h3>
        <br>
        <form id="formularioConfig">

            <label class="text-info">Nombre: (<span id="nombre"></span>)
                <span class='campo glyphicon glyphicon-chevron-down'> </span> 
            </label>
            <input type="text" id="cambiar-nombre" class="oculto form-control input">

            <label class="text-info">Apellido: (<span id="apellido"></span>)
                <span class='campo glyphicon glyphicon-chevron-down'>  </span>
            </label>
            <input type="text" id="cambiar-apellido" class="oculto input form-control">



            <label class="text-info">Fecha de nacimiento: (<span id="fecna"></span>)
                <span class='campo glyphicon glyphicon-chevron-down'>  </span>
            </label>
            <input type="text" id="cambiar-fecha" class="oculto input form-control" placeholder="DD/MM/AAAA">



            <label class="text-info">Sexo: (<span id="sexo"></span>)
                <span class='campo glyphicon glyphicon-chevron-down'>  </span>
            </label>
            <span class="oculto">
		        <input type="radio" id="cambiar-sexo" name ="sexo" value="Mujer" class="input inputSexo"/>Mujer
		        <input type="radio" id="cambiar-sexo"  name ="sexo" value="Hombre" class="inputSexo"/>Hombre
	        </span>

            <br>
            <br>
            <div>
                <input type="button" id="modificar" class="btn btn-info" value="Guardar cambios">
            </div>


        </form>
    </div>
    <br>
    <div id="errores-perfil">

    </div>

    <?php 
        } else {
            header('Location: ../loguin.html');
        } //fin del if para saber si el usuario ha iniciado sesion o no
    ?>

</body>

</html>

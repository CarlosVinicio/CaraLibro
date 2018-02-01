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
    <script src="../../JavaScript/comentarioAIntroducir.js"></script>
    <script src="../../JavaScript/likes.js"></script>
    <script src="../../JavaScript/comentarios.js"></script>
    <script src="../../JavaScript/likesComentarios.js"></script>
    <script src="../../JavaScript/eliminarPublicacion.js"></script>

    
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/amigos.css">

</head>

<body>

    <?php 
        session_start();
        include '../Base_de_datos/funcionesGenerales.php';

        if (isset($_SESSION['correo'])) { // esto sera funcional cuando la sesion del usuario ya este implementada
        
            $datosUsuario = new FunctionesGenerales();
			$numeroAmigos = $datosUsuario->numeroAmigos($_SESSION['codigoUsuario']);
            $numMensajesEnviados = $datosUsuario->numMensajesEnviados($_SESSION['codigoUsuario']);
            $numMensajesRecibidos = $datosUsuario->numMensajesRecibidos($_SESSION['codigoUsuario']);
            $cargarMuroGeneral = $datosUsuario->cargarMuroGeneral($_SESSION['codigoUsuario']);
        
        ?>
    
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
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
                    <input type="hidden" id="codigoUsuario" value="<?php echo $_SESSION['codigoUsuario'] ?>">
                    <button type="button" class="btn btn-default" id="buscarUsuario">Buscar</button>
                </form>
 
                <ul class="nav navbar-nav navbar-right">
 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notificaciones<span class="caret"></span></a>
                        <ul class="dropdown-menu">
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


    <header class="intro-header" style="background-image: url('../../Imagenes/home.jpg')">
        <div class="container">
            <div>
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1 class="colorLetra">CaraLibro</h1>
                        <hr class="small">
                        <span class="subheading colorLetra"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br>
    
    <div class="list-group barra-der-lateral">

        <div id = "cajaDatos">
            <button type="button" class="list-group-item" id="mostrarAmigos">Amigos<span class="badge"><?php echo $numeroAmigos?></span></button>
            <!--<a href="../amigos/amigos.html"class="list-group-item" >amigos <span class="badge"><?php //echo $numeroAmigos?></span></a>-->
            <a href="../amigos/paginaMensajesEnviados.php" class="list-group-item" id="mostrarMensajes"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Salida<span class="badge"><?php echo $numMensajesEnviados?></span></a>

            <a href="../amigos/paginaMensajesRecibidos.php" class="list-group-item" id="mostrarMensajesRecibidos"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Entrada<span class="badge"><?php echo $numMensajesRecibidos?></span></a>
        </div>

    </div>

    <div id="contenedorPublicaciones" class="contenedor-publicaciones">

        <div class="box profile-info n-border-top">
            
            <div id="publicacionAIntroducir">
                <h3 class="text-success">Publicaciones</h3>
                <form method="POST" action="publicacion.php">
                    <textarea class="form-control input-lg p-text-area" id="publicacionPublicacion" rows="2" placeholder="Que está pasando?"></textarea>
                    <button type="button" class="btn btn-azure boton-derecha" id="enviarPublicacion">Publicar</button>
                </form>
            </div>
        </div>

        <br><br>

           <section class="seccion_publicaciones" id="publicaciones">
            <!-- Aquí se mostrara una publicacion siempre y cuando se haya enviado dicha publicacion desd el formulario de arriba // imagino que habra q mostrarlo con alguna comprobacion de if en php-->

            <?php foreach($cargarMuroGeneral as $pintarMuro) {
                        echo $pintarMuro;
                  }
            ?>
        </section>
  
    </div>


    <?php 
        } else {
            header('Location: ../loguin.html');
        } //fin del if para saber si el usuario ha iniciado sesion o no
    ?>

</body>

</html>

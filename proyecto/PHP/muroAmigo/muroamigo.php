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
    <script src="../../JavaScript/comprobarSolicitudes.js"></script>
    <script src="../../JavaScript/mostrarAmigos.js"></script>
    <script src="../../JavaScript/muroAmigo.js"></script>
    <script src="../../JavaScript/jquery-1.12.3.min.js"></script>
    <script src="../../JavaScript/sendEmail.js"></script>
    <script src="../../JavaScript/likes.js"></script>
    <script src="../../JavaScript/likesComentarios.js"></script>
    <script src="../../JavaScript/comentarioAIntroducir.js"></script>
    <script src="../../JavaScript/comentarios.js"></script>


    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/amigos.css">

</head>

<body>
    <?php 
        session_start();
        include '../Base_de_datos/funcionesGenerales.php';
        if (isset($_SESSION['correo'])) { // esto sera funcional cuando la sesion del usuario ya este implementada
		
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

                    <li><a href="../muropropio/muroPropio.php">Perfil</a></li>

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
        <!-- Caja donde se mostrara la foto del usuario asi como algo de su informacion-->
        <div class="row">
            <div class="thumbnail" id="cajaFoto">
                <?php     
                        echo '<input type = "hidden" id = "idAmigo" value =  "' . $_GET['idUsuario']. '" />';
                            //echo '<img src="'.$imagenUsuario[2].'" alt="No se puede cargar la imagen del usuario" id="foto-perfil">';  
                        
                 ?>
                <div class="caption" id="datos-muro">

                </div>
            </div>
        </div>

    </div>

    <div id="contenedorPublicaciones" class="contenedor-publicaciones">


        <section class="seccion_publicaciones" id="publicaciones">
           
            

        </section>   
    </div>

    <?php 
        } else {
            header('Location: ../loguin.html');
        } //fin del if para saber si el usuario ha iniciado sesion o no
    ?>
</body>

</html>

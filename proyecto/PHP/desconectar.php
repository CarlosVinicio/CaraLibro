<?php
session_start();

session_unset($_SESSION['correo']);
session_unset($_SESSION['codigoUsuario']);
session_unset($_SESSION['nombre']);
session_unset($_SESSION['apellido']);
session_unset($_SESSION['fechaNacimiento']);
session_unset($_SESSION['sexo']);
session_unset($_SESSION['imagen']);


header('Location: loguin.html');


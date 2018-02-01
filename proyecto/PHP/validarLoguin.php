<?php
session_start();

include "conexion.php";


    
if (isset($_POST['email']) && isset($_POST['contrasena'])) {
    
    $resultado = '';
    
    if (preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $_POST['email'] ) ) {
        $correo = $_POST['email'];
        $contrasena = md5($_POST['contrasena']);
        
        $sql = "SELECT correo, contrasena FROM usuarios WHERE correo = '$correo' ";
        $consulta = $conexion->query($sql);
  
        if ($consulta->num_rows <= 0) {
            $resultado .= '- El correo no se encuentra registrado por ningun usuario<br>';
        } else {
            while ($fila = $consulta->fetch_assoc()) {
                
                if ($fila['contrasena'] != $contrasena) {
                    $resultado .= '-La contraseña no es correcta<br>';
                }
            }
        }
    } else {
        $resultado .= "- El correo no cumple con el formato correcto";
    }
    
    if ($resultado != '') {
            echo 'Error: <br>'  . $resultado;
    } else {
        include "Base_de_datos/funcionesGenerales.php";

        $_SESSION['correo'] = $correo;
        
        $datosUsuario = new FunctionesGenerales();

        $arrayDatos = $datosUsuario->datosUsuario($_SESSION['correo']);
        
        $_SESSION['codigoUsuario'] = $arrayDatos['codigoUsuario'];

        $_SESSION['nombre'] = $arrayDatos['nombre'];

        $_SESSION['apellido'] = $arrayDatos['apellido'];

        $_SESSION['fechaNacimiento'] = $arrayDatos['fechaNacimiento'];

        $_SESSION['sexo'] = $arrayDatos['sexo'];

        $_SESSION['imagen'] = $arrayDatos['imagen'];



        //¿contraseña?
    }

}

?>
<?php
include "conexion.php";

if(isset($_POST["correo"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["edad"]) && isset($_POST["sexo"]) && isset($_POST["password"]) && isset($_POST["password2"])){

    $correo = trim($_POST["correo"]);
    $nombre =  trim($_POST["nombre"]);
    $apellidos =  trim($_POST["apellidos"]);
    $edad =  trim($_POST["edad"]);
    $sexo =  trim($_POST["sexo"]); 
    $password =  trim($_POST["password"]);
    $password2 = trim($_POST['password2']);

    $nombre_imagen = $_FILES["imagen"]['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $ruta_provisional = $_FILES['imagen']['tmp_name'];
    $carpeta = "../Imagenes/usuariosRegistrados/";

    

    $resultado = '';

    if(strlen($correo) > 40) {
        $resultado .= "-El email supera los 40 caracteres.<br>";
    } else {
        
        if (preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $correo ) ) {
            
            $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
            $respuesta = $conexion->query($sql);
            

           while ($fila = $respuesta->fetch_assoc()) {
               if ($fila['correo'] == $correo) {
                   $resultado .= "-Correo ya registrado, prueba con otro<br>";
               }
           }

        } else {
            $resultado .= "-Está intentando ingresar un email inválido.<br>";
        }
    }

    if (strlen($nombre) > 30) {
        $resultado .= "- El nombre supera los 20 caracteres<br>";
    } else if (strlen($nombre) <4) {
        $resultado .= '- El nombre debe tener minimo 4 letras<br>';
    }
    
    if (strlen($apellidos) > 30) {
        $resultado .= "- El apellido supera los 20 caracteres<br>";
    } else if (strlen($apellidos) <4) {
        $resultado .= '- El apellido debe tener minimo 4 letras<br>';
    }

    if (is_numeric($edad)) {
        $resultado .= "- El campo fecha de nacimiento no puede ser un numero<br>";
    } else {
        if (!preg_match('/^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|[1][012])[\/]((19|20)?[0-9]{2})$/', $edad)) {
            $resultado .= "- El formato de la fecha no es el correcto<br>";
        } else{
            $trozos = explode("/", $edad);
            $anioActual = 2017;

            if ($anioActual - $trozos[2] < 18) {
                $resultado .= "- Es necesario ser mayor de edad para registrarte<br>";
            }


        }
    }

    if(strlen($password) > 30) {
        $resultado .= "- La contraseña supera los 20 caracteres.<br>";
    } else {
        
        //que contengan al menos una letra mayúscula.
        //que contengan al menos una letra minúscula.
        //que contengan al menos un número o caracter especial.
        //cuya longitud sea como mínimo 6 caracteres.
        //cuya longitud máxima no debe ser arbitrariamente limitada.

        if (!preg_match("/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password ) ) {
            $resultado .= "-La contraseña debe contener almenos: una mayuscula, una minuscula, un número, que la longitud sea como minimo 6 caracteres.<br>";
        }
    }

    if ($password != $password2) {
        $resultado .= "- Las contraseñas no coinciden.";
    }

    if ($tipo_imagen != 'image/jpg' && $tipo_imagen != 'image/jpeg' && $tipo_imagen != 'image/png' ) {
        $resultado .= "El archivo debe ser una imagen <br>";
    } 

    if ($resultado != "") {
      
        echo "<div ><strong>Error</strong><br>$resultado</div>";
    } else {
        
        $password = MD5($password);

        $fecha = time();

        $src = $carpeta.$fecha.$nombre_imagen;

        move_uploaded_file($ruta_provisional, $src);

        $ruta_imagen = "../" . $src;

        $query = "INSERT INTO usuarios VALUES(NULL, '$correo', '$nombre', '$apellidos', '$edad', '$sexo', '$ruta_imagen', '$password')";
        
        $respuesta = $conexion->query($query);
          
        echo "<div><strong>¡Correcto!</strong><br>Se ha registrado correctamente.</div>";
    }
} else {
    echo "Errores";
}


?>

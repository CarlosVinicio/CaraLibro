<?php

    
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$idusuario = $_POST['idusuario'];
	$token = $_POST['token'];
	$error = '';
	$resultado = "";
	$conexion = new mysqli('localhost', "root", "", "caralibro");
	$usuario;


	if( $password1 != "" && $password2 != "" && $idusuario != "" && $token != "" ){

		if (!preg_match("/(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password1 ) ) {
        	$error .= "-La contraseña debe contener almenos: una mayuscula, una minuscula, un número, que la longitud sea como minimo 6 caracteres.<br>";

    	} else {
			if ($password1 != $password2) {
				$error .= "Las contraseñas no coindicen";
			} else {
				
   				$sql = " SELECT * FROM tblreseteopass WHERE token = '$token' ";
				
   				$resultado = $conexion->query($sql);
				
				if( $resultado->num_rows > 0 ){
					
      				$usuario = $resultado->fetch_assoc();
					  
					if( $usuario['idusuario'] != $idusuario  ){
						$error .= "El token no es válido";		
					}
				} else{
					$error .=  "El token no es válido";
				}
			}
		}
	} else{
   		$error .= 'Alguno de los campos esta vacio o es invalido';
	}

	if (empty($error)) {
		$sql = " SELECT * FROM tblreseteopass WHERE token = '$token' ";
   		$resultado = $conexion->query($sql);

		if ($resultado->num_rows > 0) {
			$usuario = $resultado->fetch_assoc();

			$password1 = md5($password1);

			$sql = "UPDATE usuarios SET contrasena = '".$password1."' WHERE codigoUsuario = ".$usuario['idusuario'];
			$resultado = $conexion->query($sql);
			if($resultado){
				$sql = "DELETE FROM tblreseteopass WHERE token = '$token';";
				$resultado = $conexion->query( $sql );						
			}
		}	
	} else {
		echo "Error: " . $error;
 
	}
?>
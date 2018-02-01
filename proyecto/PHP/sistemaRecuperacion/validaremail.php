<?php



function generarLinkTemporal($idusuario, $correoUsuario){
    
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $idusuario.$correoUsuario.rand(1,9999999).date('Y-m-d');
      
   $token = sha1($cadena);
    
   $conexion = new mysqli('localhost', "root", "", "caralibro");
   // Se inserta el registro en la tabla tblreseteopass
   $sql = "INSERT INTO tblreseteopass (idusuario, correo, token, creado) VALUES($idusuario,'$correoUsuario','$token',NOW());";
 
   $resultado = $conexion->query($sql);

   
   if($resultado){
      // Se devuelve el link que se enviara al usuario
      
      $enlace = 'http://localhost/proyecto/PHP/sistemaRecuperacion/restablecer.html?idusuario='.$idusuario.'&token='.$token;
      return $enlace;
   }
   else
      return FALSE;
}

function enviarEmail( $email, $link ){
  
    $mensaje = '
      <html>
    <head>
    <meta charset="utf-8"/>
    </head>
    <body>
     <p>Has solicitado realizar un cambio de tu password</p>
     <p>Pincha en el siguiente enlace para proceder a la recuperacion</p>
     <a href="'.$link.'"> Restablecer password </a></body>
    </html> ';
    
	require_once ('PHPMailer-master/class.phpmailer.php');
    require_once ('PHPMailer-master//class.smtp.php');  

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->Port = 465; 
    $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
    ));
    
    $mail->Username = "caralibrojovellanos@gmail.com";
    $mail->Password = "carlosmariasergio";
    
    $mail->setFrom('caralibrojovellanos@gmail.com'); // correo desde donde se envia 
    $mail->addAddress($email); // correo al que se envia el mensaje en este caso solo 1
    
    
    $mail->Subject = 'Correo de recuperacion';
    $mail->Body = $mensaje;
    $mail->IsHTML(true);
  
    
    if($mail->send()) {
        
        return true;
    } else {
       
        return false;
    }
       
}



$email = $_POST['email'];

//$respuesta = new stdClass();
$respuesta = "";

if( !empty($email) ){
    
    if (preg_match("/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i", $email ) ) {

        $conexion = new mysqli('localhost', "root", "", "caralibro");
        $sql = " SELECT * FROM usuarios WHERE correo = '$email' ";
        $resultado = $conexion->query($sql);
        if($resultado->num_rows > 0){
        
            $usuario = $resultado->fetch_assoc();
       
            $linkTemporal = generarLinkTemporal( $usuario['codigoUsuario'], $usuario['correo'] );
        
        
            if($linkTemporal){
             
                if (enviarEmail( $email, $linkTemporal ))
                {
                    $respuesta = 'Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña';
                }
                      
            } else {
                $respuesta = 'Error :Ya se envio un correo anteriormente para realizar la recuperación';
            }
        } else {
            $respuesta  = 'Error :No existe una cuenta asociada a ese correo.';
        }
    } else {
        $respuesta = 'Error :El formato del correo no es correcto';
    }
      
} else {
     $respuesta = "Error :Debes introducir un correo para la recuperación";
}
  
echo $respuesta;

?>
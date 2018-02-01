<?php 
session_start();

class RedAmigos {

	private $ip = "localhost";
	private $usuario = "root";
	private $contrasenna = "";
	private $nombreBaseDatos = "caralibro";
	private $conexion = "";

	function conectar() {
		$this->conexion = new mysqli($this->ip, $this->usuario, $this->contrasenna, $this->nombreBaseDatos);

		if ( $this->conexion->connect_error ) {
			die("Error de conexión: " . $this->conexion->connect_errno . ", " . $this->conexion->connect_error);
		}
	}

	function desconectar() {
		$this->conexion->close();
	}

	function visualizarCoincidencias($nombre, $apellidos, $codigoUsuario) {
		$visualizar = "select * from usuarios where nombre LIKE '$nombre%' and apellido LIKE '$apellidos%' AND codigoUsuario <> '$codigoUsuario'";
        
        /*$visualizar = "select 
        *
        from
            usuarios
        where
        (nombre like '$nombre%' or apellido = '$apellidos%')
        AND codigoUsuario = (SELECT 
            codigoAmigo
        from
            amigos
        where
            codigoUsuario = $codigoUsuario
                and estadoAmistad <> 'T')
        OR codigoUsuario = (SELECT 
            codigoUsuario
        from
            amigos
        where
            codigoAmigo = $codigoUsuario and estadoAmistad <> 'T')";*/
		
		$retorno = Array();
		$resultado = $this->conexion->query($visualizar);
		
		while ( $fila = $resultado->fetch_array() ) {
			array_push($retorno, $fila);
		}

		//Retorna un array con los usuarios encontrados con el mismo orden de columnas que la base de datos.
		return $retorno;
	}

	function agregarAmigo($codigoUsuarioOrigen, $codigoUsuarioDestino) {
		$comprobarSolicitudExistente = "select * from amigos where (codigoUsuario = $codigoUsuarioOrigen and codigoAmigo = $codigoUsuarioDestino) or (codigoUsuario = $codigoUsuarioDestino and codigoAmigo = $codigoUsuarioOrigen)";
		$comprobar = $this->conexion->query($comprobarSolicitudExistente);

		if ( $comprobar->num_rows < 1 ) {
			if ( $codigoUsuarioOrigen != $codigoUsuarioDestino ) { 
				$agregarAmigo = "insert into amigos(codigoUsuario, codigoAmigo, estadoAmistad) values($codigoUsuarioOrigen, $codigoUsuarioDestino, 'P')";
				$resultado = $this->conexion->query($agregarAmigo);

				if ( $resultado > 0 ) {
				//Retorna true en el caso de que se haya mandado la solicitud correctamente.
					return true;
				} else {
				//Retorna false en el caso de que no se pueda mandar la solicitud.
					return false;
				}			
			} else {
			//retorna false si los dos códigos son iguales.
				return false;
			}
		} else {
			//Retorna falso en el caso de que haya alguna solicitud o una amistad en curso con el mismo usuario.
			return false;
		}
	}

	function comprobarSolicitudes($codigoUsuario) {
		$codigoUsuarioDestino = $_SESSION['codigoUsuario'];

		$solicitudes = "select * from usuarios where codigoUsuario in (select codigoUsuario from amigos where codigoAmigo = $codigoUsuarioDestino and estadoAmistad = 'P')";
		$todasSolicitudes = $this->conexion->query($solicitudes);
		$usuariosRetorno = Array();

		if ( $todasSolicitudes->num_rows > 0 ) {
			while ( $usuarios = $todasSolicitudes->fetch_array() ) {
				array_push($usuariosRetorno, $usuarios);
			}

			//Retorna un array con todas las peticiones que tenga el usuario, las columnas están en el mismo orden que en la base de datos.
			return $usuariosRetorno;
		} else {
			//Retorna un array vacío en el caso de que no tenga ninguna solicitud pendiente.
			return $usuariosRetorno;
		}
	}

	function aceptarSolicitud($primerUsuario, $segundoUsuario) {
		$confirmarAmistad = "update amigos set estadoAmistad = 'T' where codigoUsuario = $primerUsuario and codigoAmigo = $segundoUsuario";

		$amistadConfirmada = $this->conexion->query($confirmarAmistad);

		if ( $amistadConfirmada > 0 ) {
			//Retorna true en el caso de que la amistad esté confirmada.
			return true;
		} else {
			//Retorna false en el caso de que no se haya podido concluir la amistad
			return false;
		}
	}
	
	 function eliminarAmigo($primerUsuario, $segundoUsuario) {
        //$borrarAmigoUpdate = "delete from amigos where codigoAmistad = (select codigoAmistad from amigos where (codigoUsuario = $primerUsuario or codigoUsuario = $segundoUsuario) and (codigoAmigo = $primerUsuario or codigoAmigo = $segundoUsuario))";
 
        $borrarAmigoUpdate = "delete from amigos where (codigoUsuario = $primerUsuario AND codigoAmigo = $segundoUsuario) OR (codigoUsuario = $segundoUsuario AND codigoAmigo = $primerUsuario) AND estadoAmistad = 'T'";
         
        $amistadEliminada = $this->conexion->query($borrarAmigoUpdate);
 
        return $amistadEliminada;
         
        if ( $amistadEliminada > 0 ) {
            //Retorna un true en el caso de que la amistad se haya podido eliminar satisfactoriamente.
            return true;
        } else {
            //Retorna false en el caso de que la amistad no se haya podido eliminar salistactoriamente.
            return false;
        }
    }
 
    function visualizarAmigos($idUsuario) {
        
        $select = "select * from usuarios where codigoUsuario in (select codigoUsuario from amigos where codigoAmigo = $idUsuario  AND estadoAmistad LIKE '%T')";
 
        $amigos = $this->conexion->query($select);
        $usuariosRetorno = Array();
 
        if ( $amigos->num_rows > 0 ) {
            while ( $usuarios = $amigos->fetch_array() ) {
                array_push($usuariosRetorno, $usuarios);
            }
        }
               
        $select = "select * from usuarios where codigoUsuario in (select codigoAmigo from amigos where codigoUsuario = $idUsuario  AND estadoAmistad LIKE '%T')";
 
        $amigos = $this->conexion->query($select);
 
        if ( $amigos->num_rows > 0 ) {
            while ( $usuarios = $amigos->fetch_array() ) {
                array_push($usuariosRetorno, $usuarios);
            }
        }
 
        return $usuariosRetorno;
    }
}

<?php
	
	/**
	* Clase diseñada para realizar todas las activadades relacionadas con el
	* manejo al momento de ingresar los datos 
	*/
	class Agregar_Datos extends Base_Datos
	{
		
		function limpiar_datos($nombre, $foto, $comen){

			/**
			*Método utilizado para limpiar todos los datos ingresados por el
			* usuario
			* */

			$nom_limp = mysql_real_escape_string( utf8_decode($nombre) );
			$foto_limp = mysql_real_escape_string( utf8_decode($foto) );
			$comen_limp = mysql_real_escape_string( utf8_decode($comen) );			

			$datos["nombre"] = $nom_limp;
			$datos["foto"] = $foto_limp;
			$datos["comentario"] = $comen_limp;		

			return $datos;
		}

		function insertar_datos_bd($datos){

			/**
			*Realiza la inserción de los datos en la base de datos
			* */

			$consulta = sprintf("INSERT INTO usuarios (nombre, foto, comentario) VALUES ('%s', '%s', '%s')", $datos["nombre"], $datos["foto"], $datos["comentario"] );

			if(!$this->conectar_bd()){

				//Error al conectarse a la base de datos
				return false;

			}elseif(!mysql_query($consulta)){

				//Si no puedo ejecutar la consulta
				return false;
			}else{

				//Consulta ejecutada con éxito
				$this->cerrar_sesion();
				return true;
			}

		}
	}

?>
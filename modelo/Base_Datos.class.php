<?php

	/**
	* Esta clase se encarga de gestionar la conexión y la desconexión a la
	* base de datos
	*/
	class Base_Datos
	{
		
		const host = "localhost";
		const usuario = "root";
		const clave = "diego123";
		const bd = "comentarios_youtube"; 

		function conectar_bd(){

			/**
			*Función booleana que se encargda de gestionar la conexión
			* a la base de datos
			* */

			if(!mysql_connect(self::host, self::usuario, self::clave)){
				//Si no se pudo conectar
				return false; 
			}elseif(!mysql_select_db(self::bd)){
				//Si no pudo seleccionar la base datos
				return false;
			}else{
				//Seleccionando el juego de carácteres
				mysql_query("SET NAMES: 'utf8'");
				return true;
			}
		}

		function cerrar_sesion(){
			/**
			*Función booleana que se encarga de cerrar la conexión a la db
			* */

			if(mysql_close()){
				return true;
			}else{
				return false;
			}
		}

		
	}

?>
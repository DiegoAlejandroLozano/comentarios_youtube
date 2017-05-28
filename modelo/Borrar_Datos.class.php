<?php
	
	/**
	* Clase encargada de manejar el proceso de borrar un comentario de la 
	* base de datos
	*/
	class Borrar_Datos extends Base_Datos
	{
		
		function borrar_registro($id){

			/**
			*Método público encargado de abrir la conexión a la bd, ejecutar la
			* consulta y cerrar la conexión 
			* */

			if( !$this->conectar_bd() ){

				//Si no se pudo conecta a la base de datos
				return false;

			}elseif( !$this->realizar_consulta($id) ){

				//Si no se pudo realizar la consulta
				return false;

			}else{

				//Si se realizó la consulta con éxito
				return true;

			}

		}

		function obtener_nombre_foto($id){

			/**
			*Método público encargado de obtener el nombre de la
			* foto de la base de datos. 
			* */

			if( !$this->conectar_bd() ){

				//Si no se pudo conecta a la base de datos
				return false;

			}elseif( !$nom_foto = $this->realizar_consulta_foto($id) ){
				
				//Si no puedo realizar la consulta de la foto
				return false;

			}else{

				return $nom_foto;
				
			}

		}

		private function realizar_consulta($id){

			/**
			*Método privado encargado de ejecutar la consulta para borrar 
			* un registro de la base de datos
			* */

			$sql = sprintf("DELETE FROM usuarios WHERE id='%s' ", $id);

			if(mysql_query($sql)){
				return true;
			}else{
				return false;
			}
		}

		private function realizar_consulta_foto($id){
			/**
			*Realiza la consulta para obtener la foto del usuario
			* */

			$sql = sprintf("SELECT foto FROM usuarios WHERE id = '%s' ", $id);

			if( $datos = mysql_query($sql) ){

				$registro = mysql_fetch_array($datos);

				$this->cerrar_sesion();

				return $registro["foto"];

			}else{

				return false;

			}
		}
	}
	
?>
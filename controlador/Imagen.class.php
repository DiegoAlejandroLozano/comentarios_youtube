<?php
	
	/**
	*Clase encargada de procesar la imagen enviada por el 
	* usuario al servidor
	*/
	class Imagen
	{
		
		function mover_imagen_dir($imagen){

			/**
			*Mueve la imagen del directorio temporal al
			* directorio definitivo
			* */

			if(!$this->verificar_error($imagen)){
				return false;
			}else{

				$dir_desitino = dirname(__DIR__) . "/recursos/img_perfiles/";
				move_uploaded_file($imagen["tmp_name"], $dir_desitino . $imagen["name"]);

				return true;
			}

		}

		private function verificar_error($img){

			//Verifica si hubo un error al momento de subir el archivo

			if(!$img["error"] > 0){
				return true;
			}else{
				return false;
			}

		}
	}

?>
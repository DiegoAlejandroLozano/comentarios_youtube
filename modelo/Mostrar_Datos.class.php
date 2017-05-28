<?php
	
	/**
	* Esta clase se encarga de administrar cualquier proceso relacionado
	* con la lectura de datos en la base de datos
	*/
	class Mostrar_Datos extends Base_Datos
	{
		
		function mostrar_datos_bd(){

			/*Método utilizado para leer los datos almacenados en la bd*/

			if( !$this->conectar_bd() ){
				return false;
			}elseif ( !$datos = $this->realizarConsulta() ) {
				return false;
			}else{
				$codigo_generado = $this->generar_HTML($datos);
				return $codigo_generado;
			}
		}

		private function realizarConsulta(){

			/**
			*Este método privado realiza la consulta en la base de
			* de datos. Devuelve los datos en caso de éxito o false si 
			* se presenta algún error.
			* */

			$sql = "SELECT * FROM usuarios";

			if($datos = mysql_query($sql) and mysql_num_rows($datos) > 0){
				return $datos;
			}else{
				return false;
			}

		}

		private function generar_HTML($datos){

			/**
			*Método privado cuya finalidad es generar el código HTML que se mostrará
			* en la vista
			* */

			$codigo = "";

			while($registro = mysql_fetch_array($datos)){

				$nom_foto = utf8_encode($registro["foto"]);
				$nombre = utf8_encode($registro["nombre"]);
				$comentario = utf8_encode($registro["comentario"]);
				$id = utf8_encode($registro["id"]);

				$ruta_foto = "recursos/img_perfiles/" . $nom_foto;

				$codigo .= '

					<div class="comen_usu">
						<img src="'. $ruta_foto .'" alt="'. $nom_foto .'">
						<p class="nombre_usuario">'.
							$nombre
						.'</p>
						<a href="" id="'. $id .'" class="boton_borrar">
							<i class="fa fa-window-close" aria-hidden="true"></i>
						</a>
						<p>
							'. $comentario .'
						</p>
					</div>

				';

			}

			return $codigo;

		}	

	}

?>
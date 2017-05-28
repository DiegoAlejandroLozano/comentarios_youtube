<?php
	//includes...
	
	include("Imagen.class.php");

	include( dirname(__DIR__) . "/modelo/Base_Datos.class.php" );
	include( dirname(__DIR__) . "/modelo/Agregar_Datos.class.php" );
	include( dirname(__DIR__) . "/modelo/Mostrar_Datos.class.php" );
	include( dirname(__DIR__) . "/modelo/Borrar_Datos.class.php" );
?>


<?php

	//Entrada al controlador...

	switch ($_POST["controlador"]) {

			//Selecciona cual controlador que se usará

		case "agregar_datos":
			agregar_datos();
			break;

		case "mostrarDatos";
			mostrarDatos();
			break;

		case "borrar_comentario";
			borrar_comentario();
			break;

		default:
			echo "Datos vacíos";
			exit();
			break;
	}
?>

<?php
	
	//Funciones del controlador.....

	function agregar_datos(){
		/**
		*Controlador encargado de agrear datos a la base 
		*de datos
		* */

		$proc_img = new Imagen();

		$estado = "";
		$codigo = "";

		if(!$proc_img->mover_imagen_dir($_FILES["foto"])){

			//Se ejecuta cuando ocurre un error al subir la foto

			$estado = "Error al subir la imagen";
			$codigo = "Error al subir la imagen";

		}else{
			
			/*Si no hubo ningún error al mometo de subir la foto, se procede a 
			agregar el registro a la bd*/

			$agregar_datos = new Agregar_Datos();

			$datos_limpios = $agregar_datos->limpiar_datos(
				$_POST["nombre"], 
				$_FILES["foto"]["name"], 
				$_POST["comentario"] 
			);
			

			if( $agregar_datos->insertar_datos_bd($datos_limpios) ){	

				//si se agrega el comentario exitosamente

				$estado = "El comentario se ha agregado exitósamente";

				if( !$codigo = leer_comentarios() ){

					//Si ocurre algún error al momento de leer los comentarios
					$codigo = "Error al leer los comentarios";
				}

			}else{

				$estado = "Error al agregar el comentario";
				$codigo = "Error al leer los comentarios";

			}			

		}

		//Se genera una respuesta tipo JSON al cliente
		$json_datos = array("estado"=>$estado, "codigo"=>$codigo);
		echo json_encode($json_datos);	
	}

	function mostrarDatos(){

		/*Comentario utilizado para mostrar los comentarios en la vista*/

		if($comentario = leer_comentarios()){
			echo $comentario;
		}else{
			echo "Sin comentarios...";
		}

	}

	function borrar_comentario(){

		/*Borra un comentario*/

		$borrar_datos = new Borrar_Datos();
		$foto  = $borrar_datos->obtener_nombre_foto( $_POST["id"] );

		$estado = "";
		$codigo = "";

		if( !$borrar_datos->borrar_registro($_POST["id"]) ){

			$estado = "Error al elimar el comentario";

		}elseif (!eliminar_foto_servidor($foto)) {
			
			$estado = "Error al eliminar la foto del servidor";

		}else{

			$estado = "El comentario se borró exitosamente";
		}

		$codigo = leer_comentarios();

		$json_datos = array("estado"=>$estado, "codigo"=>$codigo);
		echo json_encode($json_datos);
	}

	
?>

<?php

	//Funciones de trabajo...

	function leer_comentarios(){

		/*Lee los comentarios registrados en la bd*/

		$mostrar_datos = new Mostrar_Datos();

		if($codigo = $mostrar_datos->mostrar_datos_bd()){
			return $codigo;
		}else{
			return false;
		}

	}

	function eliminar_foto_servidor($foto){
		//Elimina la foto del servidor

		$dir_foto = dirname(__DIR__) . "/recursos/img_perfiles/" ;

		if( unlink( $dir_foto . $foto ) ){
			//Se borro la imagen con éxito
			return true;
		}else{
			//Error al borrar la imagen
			return false;
		}

	}
	
?>
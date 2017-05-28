<!-- http://localhost/mi_archivos/ejercicios_hechos_por_mi/Comentarios_youtube/ -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Comentarios Youtube</title>
	
	<link rel="stylesheet" href="recursos/css/index.css">
	<link rel="stylesheet" href="recursos/css/font-awesome.min.css">

	<script src="recursos/js/jquery-3.2.1.min.js" ></script>
	<script src="recursos/js/index.js"></script>
	 
</head>
<body>
	
	<div id="contenedor">	

		<div id="cont_video">			
			<iframe width="560" height="315" src="https://www.youtube.com/embed/xmBNWGknf7Q" frameborder="0" allowfullscreen></iframe>
		</div>
		
		<form action="" method="post" id="formulario" name="formulario" enctype="multipart/form‐data"> 
			
			<fieldset>
				
				<legend>Agrega tu comentario</legend>
				
				<p>
					<label for="">Nombre</label>
					<input type="text" name="nombre" placeholder="nombre" required="">
				</p>

				<p>
					<textarea name="comentario" id="comentario" cols="30" rows="10" placeholder="comentario" required=""></textarea>
				</p>

				<p>
					<label for="">foto</label>
					<input type="hidden" name="MAX_TAM" value="2097152">
					<input type="file" name="foto" id="foto" required="">
				</p>

				<p>
					<input type="submit" value="Enviar" id="btn_enviar">
				</p>
				
			</fieldset>			
			
		</form>
		
		<div id="comentarios">	
			
		</div>	
		
	</div>
	
</body>
</html>
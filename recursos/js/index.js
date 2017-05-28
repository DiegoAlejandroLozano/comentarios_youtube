$( document ).ready(function() {

	iniciar(); 

	/*Cuando el evento que se quiere controlar es SUBMIT, este se debe
	agregar al formulario y no al botón enviar.*/
   	$("#formulario").on("submit", enviar_datos);

   	$("#comentarios").on("click", ".boton_borrar", borrar_datos);

});

function iniciar(){

	/*Función a ejecutar cuando se inicia la página. Se encarga
	de inicializar la página, con los comentarios almacenados en 
	la bd*/

	var data_form = new FormData();
	data_form.append("controlador", "mostrarDatos");

	$.ajax(

		{
			type 		: 		"POST",
			url  		:  		"controlador/Controlador.php",
			data 		:  		data_form,
			contentType :  		false,
			processData :    	false,
			success: function(result,status,xhr){
				if( status == "success" ){
					$("#comentarios").html(result);
				}
			},

			beforeSend : function(){
				$("#comentarios").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>');
			},

			error: function(xhr,status,error){
				if( status == "error" ){
					alert("los datos no llegaron");
				}
			}
		}

	);

}

function enviar_datos(e){

	/*Manejador de eventos que se ejecuta, cuando el usuario quiere agregar
	un nuevo registro a la base datos!*/

	e.preventDefault();

	var formulario = document.formulario; //Almacena el formulario en la variable 
	var data_form = new FormData(formulario);

	//agregando información adicional
	data_form.append("controlador", "agregar_datos");

	$.ajax({

		type 		: 		"POST",
		url 		:  		"controlador/Controlador.php",
		data 		: 		data_form,
		dataType  	:  		"json",
		contentType : 		false, //Necesario para enviar data_form
		processData : 		false, //Necesario para enviar data_form

		success	: function(result){
			alert(result.estado);
			$("#comentarios").html(result.codigo);
		},

		beforeSend : function(){
			$("#comentarios").html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>');
		},

		error: function(){
			console.log("error");
		}

	});

}

function borrar_datos(e){

	/*Función a ejecutar cuando el usuario quiera borrar un 
	comentario*/

	e.preventDefault();

	// alert("El atributo es: " + $(this).attr("id"));

	var form_data = new FormData();

	form_data.append("controlador", "borrar_comentario");
	form_data.append("id", $(this).attr("id"));

	$.ajax(

		{
			type 		: 		"POST",
			url 		:  		"controlador/Controlador.php",
			data 		: 		form_data,
			dataType  	:  		"json",
			contentType : 		false, //Necesario para enviar data_form
			processData : 		false, //Necesario para enviar data_form

			success	: function(result){
				alert(result.estado);
				$("#comentarios").html(result.codigo);
			},

			error: function(xhr,status,error){
				console.log(error);
			}
		}

	);

}


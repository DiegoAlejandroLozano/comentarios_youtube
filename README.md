# comentarios_youtube
Aplicación web que simula el sistema de comentarios de Youtube / Web application that simulates the YouTube comment system

Aplicación web programada en PHP mediante POO y haciendo uso del patrón MVC, la cual simula el sistema de comentarios de Youtube. La aplicación cuenta con un formulario, en el cual se puede ingresar el nombre del usuario y el comentario, además, permite seleccionar una imagen que identificará a la persona que realice la publicación.

Los datos del formulario son enviados a un controlador, el cual se encarga de almacenarlos en una base de datos a través de la interacción con el modelo. Una vez estos datos son almacenados en la bd, se procede a publicarlos en la página mediante comunicación AJAX. Esta comunicación permite que cada vez que se agregue un nuevo comentario, se visualice en la parte inferior de la página sin necesidad de recargarla.

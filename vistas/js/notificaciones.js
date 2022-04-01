/*=============================================
ACTUALIZAR NOTIFICACIONES
=============================================*/
$(".actualizarNotificaciones").click(function(e){

	e.preventDefault();

	var tipo = $(this).attr("tipo");
  var codnot = $(this).attr("codnot");

	var datos = new FormData();
 	datos.append("tipo", tipo );
  datos.append("codnot", codnot );

  	$.ajax({

  		 url:"ajax/notificaciones.ajax.php",
  		 method: "POST",
	  	 data: datos,
	  	 cache: false,
			 global: false,
       contentType: false,
       processData: false,
       success: function(respuesta){

  		  	if(respuesta == "ok"){

      	    	if(tipo == "ticket"){

      	    		window.location = "tickets";

      	    	}

      	    	if(tipo == "reclamo"){

      	    		window.location = "reclamacionesweb";

      	    	}

      	    }

      	 }

  	})
})


$(document).ready(function(){

   recargarSubmodulosNU();
   recargarSubmodulosEDI();

   $('#seleccionarModuloN3').change(function(){

      recargarSubmodulosNU();

   });

   $('#editarModuloN3').change(function(){

      recargarSubmodulosEDI();

   });

})

/*=============================================
 LLENAR SUBMODULOS SEGUN MODULO SELECCIONADO
=============================================*/
function recargarSubmodulosNU(){

  var idModuloN3 = $('#seleccionarModuloN3').val();

  var datos = new FormData();
  datos.append("idModuN3", idModuloN3);

  $.ajax({
      url: "ajax/modulo.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

        $("#seleccionarSubModuloN3").html(respuesta);

      }

  })

}

function recargarSubmodulosEDI(){

  var idModuN3ED = $('#editarModuloN3').val();

  var datos = new FormData();
  datos.append("idModuN3ED", idModuN3ED);

  $.ajax({
      url: "ajax/modulo.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

        $("#editarSubModuloN3").html(respuesta);

      }

  })

}

/*=============================================
EDITAR MODULO NIVEL 1
=============================================*/
$(".tablas").on("click", ".btnEditarModuloN1", function(){

	var idModulo = $(this).attr("idModulo");

	var datos = new FormData();
	datos.append("idModulo", idModulo);

	$.ajax({
		  url: "ajax/modulo.ajax.php",
	 	  method: "POST",
      data: datos,
      cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

				var resp = respuesta[0];

     		$("#editarModulo").val(resp["descripcion"]);
        $("#editarIcono").val(resp["icono"]);
     		$("#idN1").val(resp["idmodulo"]);

     	}

	})


})

/*=============================================
EDITAR MODULO NIVEL 2
=============================================*/
$(".tablas").on("click", ".btnEditarModuloN2", function(){

	var idSubmodulo = $(this).attr("idSubmodulo");

	var datos = new FormData();
	datos.append("idSubmodulo", idSubmodulo);

	$.ajax({
		  url: "ajax/modulo.ajax.php",
	 	  method: "POST",
      data: datos,
      cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

				var resp = respuesta[0];

     		$("#editModulo").val(resp["idmodulo"]);
				$("#editModulo").html(resp["modulo"]);
        $("#editarSubmodulo").val(resp["descripcion"]);
				$("#editarRutaSubmod").val(resp["ruta"]);
     		$("#idN2").val(resp["idsubmod"]);

     	}

	})


})

/*=============================================
EDITAR MODULO NIVEL 3
=============================================*/
$(".tablas").on("click", ".btnEditarModuloN3", function(){

	var idTrimodulo = $(this).attr("idTrimodulo");

	var datos = new FormData();
	datos.append("idTrimodulo", idTrimodulo);

	$.ajax({
		  url: "ajax/modulo.ajax.php",
	 	  method: "POST",
      data: datos,
      cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

				var resp = respuesta[0];

     		$("#editModuloN3").val(resp["idmodulo"]);
				$("#editModuloN3").html(resp["modulo"]);
        $("#editSubModuloN3").val(resp["idsubmod"]);
				$("#editSubModuloN3").html(resp["submodulo"]);
        $("#editarTrimodulo").val(resp["descripcion"]);
				$("#editarRutaTrimod").val(resp["ruta"]);
     		$("#idN3").val(resp["idtmod"]);

     	}

	})


})

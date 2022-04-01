var idUsuarioGen = sessionStorage.getItem('idUsuario');
/*=============================================
CARGAR LA TABLA DINÁMICA DE RECLAMACIONES
=============================================*/
$('.tablaReclama').DataTable( {
   "ajax": "ajax/datatable-reclamacion.ajax.php",
   "deferRender": true,
	 "stateSave": true,
	 "processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE RECLAMACIONES ASIGNADOS
=============================================*/
$('.tablaReclamaAsig').DataTable( {
    "ajax": "ajax/datatable-reclamaAsignado.ajax.php?id_usuario="+idUsuarioGen,
    "deferRender": true,
  	"stateSave": true,
  	"processing": true,
  	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

});

/*=============================================
ASIGNAR TICKET
=============================================*/
// $(".tablaReclama").on("click", ".btnAsigTicket", function (){
//
//   var codigo = $(this).attr("idTicket");
//   var usuario = sessionStorage.getItem("usuario");
//
//   var data = new FormData();
//   data.append("codigo", codigo);
//   data.append("usuario", usuario);
//
//   $.ajax({
//
//     url: "ajax/reclamo.ajax.php",
//     method: "POST",
//     data: data,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (resp) {
//
//       var respuesta = resp;
//
//       if (respuesta) {
//
//         swal({
//             type: "success",
//             title: "¡El Ticket N° "+codigo+" fue asignado correctamente!",
//             showConfirmButton: true,
//             confirmButtonText: "Cerrar"
//             }).then(function(result){
//             if (result.value) {
//
//               window.location = "reclamacionesweb";
//
//             }
//           })
//
//       }else{
//
//         swal({
//             type: "error",
//             title: "¡hubo un error al registrar!",
//             showConfirmButton: true,
//             confirmButtonText: "Cerrar"
//             }).then(function(result){
//             if (result.value) {
//
//               window.location = "reclamacionesweb";
//
//             }
//           })
//
//       }
//
//     }
//
//   });
//
//
// })


/*=============================================
VER RECLAMO
=============================================*/
$(".tablaReclama").on("click", ".btnVerReclamo", function (){

	var idReclamo = $(this).attr("idReclamo");

	var data = new FormData();
	data.append("idReclamo", idReclamo);

	$.ajax({

		url: "ajax/reclamo.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			console.log(respuesta);
      $("#codReclamo").html("Hoja de Reclamación N° "+idReclamo);
			$("#fechaReclamo").html("Fecha: "+respuesta["fecha"]);
			$("#nombReclamo").val(respuesta["nombre"]);
			$("#domicilio").val(respuesta["domicilio"]);
			$("#NroDoc").val(respuesta["documento"]);
      $("#telfReclamo").val(respuesta["telefono"]);
      $("#email").val(respuesta["correo"]);
      $("#monto").val(respuesta["monto_reclamado"]);
      $("#descripcion").val(respuesta["descripcion"]);

      $("#detalle").val(respuesta["detalle"]);
      $("#pedido").val(respuesta["pedido"]);

      $("#fechaResp2").val(respuesta["fecharesp"]);
      $("#respReclamo2").val(respuesta["detalle_respuesta"]);

      //VALIDACION DE TIPO DE BIEN RECLAMADO
			if (respuesta["tipo_bien"] == "PRODUCTO") {

				$("#optradioP").attr("checked", true);
        $("#optradioS").attr("checked", false);

			} else {

        $("#optradioP").attr("checked", false);
				$("#optradioS").attr("checked", true);

			}

      //VALIDACION DE TIPO DE RECLAMO
      if (respuesta["tipo_reclamo"] == "RECLAMO") {

				$("#optradioTR").attr("checked", true);
        $("#optradioTQ").attr("checked", false);

			} else {

        $("#optradioTR").attr("checked", false);
				$("#optradioTQ").attr("checked", true);

			}

		}

	});

})

/*=============================================
VER RECLAMO (ASIGNADO)
=============================================*/
$(".tablaReclamaAsig").on("click", ".btnVerReclamo", function (){

	var idReclamo = $(this).attr("idReclamo");

	var data = new FormData();
	data.append("idReclamo", idReclamo);

  var screen = $('#loading-screen');
  configureLoadingScreen(screen);

	$.ajax({

		url: "ajax/reclamo.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			console.log(respuesta);
      $("#codReclamo").html("Hoja de Reclamación N° "+idReclamo);
			$("#fechaReclamo").html("Fecha: "+respuesta["fecha"]);
			$("#nombReclamo").val(respuesta["nombre"]);
			$("#domicilio").val(respuesta["domicilio"]);
			$("#NroDoc").val(respuesta["documento"]);
      $("#telfReclamo").val(respuesta["telefono"]);
      $("#email").val(respuesta["correo"]);
      $("#monto").val(respuesta["monto_reclamado"]);
      $("#descripcion").val(respuesta["descripcion"]);

      $("#detalle").val(respuesta["detalle"]);
      $("#pedido").val(respuesta["pedido"]);

      $("#fechaResp2").val(respuesta["fecharesp"]);
      $("#respReclamo2").val(respuesta["detalle_respuesta"]);

      //VALIDACION DE TIPO DE BIEN RECLAMADO
			if (respuesta["tipo_bien"] == "PRODUCTO") {

				$("#optradioP").attr("checked", true);
        $("#optradioS").attr("checked", false);

			} else {

        $("#optradioP").attr("checked", false);
				$("#optradioS").attr("checked", true);

			}

      //VALIDACION DE TIPO DE RECLAMO
      if (respuesta["tipo_reclamo"] == "RECLAMO") {

				$("#optradioTR").attr("checked", true);
        $("#optradioTQ").attr("checked", false);

			} else {

        $("#optradioTR").attr("checked", false);
				$("#optradioTQ").attr("checked", true);

			}

		}

	});

})

/*=============================================
RESPONDER RECLAMO
=============================================*/
$(".tablaReclama").on("click", ".btnResponder", function (e){

	var idReclamo2 = $(this).attr("idReclamo");
  var estado = $(this).attr("estado");
  var idUser = sessionStorage.getItem('idUsuario');

  if (estado != 2) {

    $("#codReclamo2").html("Hoja de Reclamación N° "+idReclamo2);
    $("#codReclamacion2").val(idReclamo2);
    $("#idUsua").val(idUser);

  }else{

    // $(tablaReclama).removeAttribute("data-toggle");
    // $(this).removeAttribute("data-target");

    // e.stopPropagation();

    swal({
        type: "error",
        title: "¡El Reclamo N° "+idReclamo2+" ya fue respondido!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result){
        if (result.value) {

          window.location = "reclamacionesweb";

        }
      })

  }



})

/*=============================================
RESPONDER RECLAMO (ASIGNADO)
=============================================*/
$(".tablaReclamaAsig").on("click", ".btnResponder", function (e){

	var idReclamo2 = $(this).attr("idReclamo");
  var estado = $(this).attr("estado");
  var idUser = sessionStorage.getItem('idUsuario');

  if (estado != 2) {

    $("#codReclamo2").html("Hoja de Reclamación N° "+idReclamo2);
    $("#codReclamacion2").val(idReclamo2);
    $("#idUsua").val(idUser);

  }else{

    e.stopPropagation();

    swal({
        type: "error",
        title: "¡El Reclamo N° "+idReclamo2+" ya fue respondido!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result){
        if (result.value) {

          window.location = "reclamacionesweb";

        }
      })

  }



})

/*=============================================
BOTON ASIGNAR RECLAMO (RESPONSABLE)
=============================================*/
$(".tablaReclama").on("click", ".btnAsigReclamo", function(e){

  var codigo = $(this).attr("idReclamo");

  $("#codigoRecla").val(codigo);

});

/*=============================================
RESPONDER RECLAMO
=============================================*/
$("#btnGuardarReclamo").on("click", function (){

  var formulario = document.getElementById('formRespReclamo');
  // var respuestaRec = $('#respReclamo').val();
  // var respuestaRec = document.getElementById("respReclamo").value;
  // var data = $("#formRespReclamo").serializeArray();
  var data = new FormData(formulario);

  $.ajax({

    url: "ajax/respReclamo.ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resp) {

      screen.fadeIn();

      if(resp == "1"){

        swal({
            type: "success",
            title: "La respuesta al reclamo ha sido registrada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "reclamacionesweb";

                }
              })

      }else{

        swal({
            type: "error",
            title: resp,
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
            if (result.value) {

              window.location = "reclamacionesweb";

            }
          })

      }

    }

  });


})


function configureLoadingScreen(screen){
    $(document)
        .ajaxStart(function () {
            screen.fadeIn();
        })
        .ajaxStop(function () {
            screen.fadeOut();
        });
}

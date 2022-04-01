var usuario = $("#id_user").val();
/*=============================================
CARGAR LA TABLA DINÁMICA DE MOVIMIENTOS DE IMPORTACION
=============================================*/

$('.tablaTickets').DataTable( {
    "ajax": "ajax/datatable-tickets.ajax.php?id_usuario="+usuario,
	  dom: "Bfrtilp",
    "deferRender": true,
	  "stateSave": true,
	  "ordering": false,
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

	},
	buttons: [
		{
			extend: 'excelHtml5',
			text: '<i class="fa fa-file-excel-o"></i> ',
			titleAttr: 'Exportar a Excel',
			className: 'btn btn-success',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
		{
			extend: 'pdfHtml5',
			text: '<i class="fa fa-file-pdf-o"></i> ',
      orientation: 'landscape',
			titleAttr: 'Exportar a PDF',
			className: 'btn btn-danger',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
		{
			extend: 'print',
			text: '<i class="fa fa-print"></i> ',
			titleAttr: 'Imprimir',
			className: 'btn btn-info',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
	],
    //SE CREA FILTRO DE DATOS SEGUN LO SOLICITADO (PROVEEDOR)
	initComplete: function () {
		this.api().columns([5]).every(function () {
			var column = this;
			var select = $('<select class="form-control input-lg-3"><option value="">TODOS</option><option value="abierto">abierto</option><option value="pendiente">pendiente</option><option value="resuelto">resuelto</option><option value="esperando al cliente">esperando al cliente</option><option value="cerrado">cerrado</option></select>')
				.appendTo('#selectEstado')
				.on('change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
					);

					column
						.search(val ? '^' + val + '$' : '', true, false)
						.draw();
				});
		});
	 }
});


$('.tablaTicketsAsignado').DataTable( {
    "ajax": "ajax/datatable-ticketsAsignado.ajax.php?id_usuario="+usuario,
    "deferRender": true,
	"stateSave": true,
	"ordering": false,
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

	},
	dom: "Bfrtilp",
	buttons: [
		{
			extend: 'excelHtml5',
			text: '<i class="fa fa-file-excel-o"></i> ',
			titleAttr: 'Exportar a Excel',
			className: 'btn btn-success',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
		{
			extend: 'pdfHtml5',
			text: '<i class="fa fa-file-pdf-o"></i> ',
      orientation: 'landscape',
			titleAttr: 'Exportar a PDF',
			className: 'btn btn-danger',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
		{
			extend: 'print',
			text: '<i class="fa fa-print"></i> ',
			titleAttr: 'Imprimir',
			className: 'btn btn-info',
			exportOptions: {
                columns: [0,1,2,3,4,5,6,7]
            }
		},
	],
    //SE CREA FILTRO DE DATOS SEGUN LO SOLICITADO (PROVEEDOR)
	initComplete: function () {
		this.api().columns([5]).every(function () {
			var column = this;
			var select = $('<select class="form-control input-lg-3"><option value="">TODOS</option><option value="abierto">abierto</option><option value="pendiente">pendiente</option><option value="resuelto">resuelto</option><option value="esperando al cliente">esperando al cliente</option><option value="cerrado">cerrado</option></select>')
				.appendTo('#selectEstado')
				.on('change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
					);

					column
						.search(val ? '^' + val + '$' : '', true, false)
						.draw();
				});
		});
	 }
});

/*=============================================
BOTON VER HISTORIAL
=============================================*/
$(".tablaTickets").on("click", ".btnVer", function(){

  var codigo = $(this).attr("codigoTK");

  window.location = "index.php?ruta=ticket-vista&cod="+codigo;

});

/*=============================================
BOTON VER HISTORIAL
=============================================*/
$(".tablaTicketsAsignado").on("click", ".btnVer", function(){

  var codigo = $(this).attr("codigoTK");

  window.location = "index.php?ruta=ticket-vista&cod="+codigo;

});

/*=============================================
BOTON ASIGNAR TICKET (RESPONSABLE)
=============================================*/
$(".tablaTickets").on("click", ".btnAsignar", function(){

  var codigo = $(this).attr("codigoTK");
  // var idUsuario = sessionStorage.getItem('idUsuario');
  $("#codigoTik").val(codigo);

});

$('#seleccionarTrabajArea').change(function(){

      recargarTrabajadores();

});

//LLENAR TRABAJADORES SEGUN AREA
function recargarTrabajadores(){

  var idArea = $('#seleccionarTrabajArea').val();

  var datos = new FormData();
  datos.append("idArea", idArea);

  $.ajax({
      url: "ajax/roles.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      global: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        $("#muestraTrabajadorAjax").empty();
        $("#muestraTrabajadorAjax").append(respuesta);

      }

  })

}

/*=============================================
BOTON CERRAR TICKET
=============================================*/
$(".btnCerrarTicket").on("click", function(){

  var codigo = $(this).attr("codigoTicket");
  var idUsuario = sessionStorage.getItem('idUsuario');

  swal({
   title: '¿Está seguro de Cerrar el Ticket N° '+codigo+' ?',
   text: "¡Si no lo está puede cancelar la acción!",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   cancelButtonText: 'Cancelar',
   confirmButtonText: 'Si, Cerrar Ticket!'
  }).then(function(result){

   if(result.value){

     window.location = "index.php?ruta=tickets&CerrarTicket="+codigo+"&idUsuario="+idUsuario;

   }

  })

});

/*=============================================
BOTON RESPONDER TICKET (SOPORTE)
=============================================*/
$(".btnAgregarRespuesta").on("click", function(){

  var codigo = $(this).attr("codigoTicket");

  $("#nroticket").val(codigo);
  $("#nroticket2").val(codigo);

});

/*=================================================
SUBIENDO ARCHIVOS ADJUNTOS A LA RESPUESTA DE TICKET
==================================================*/

$(".subirAdjuntos2").change(function(){

  var archivos = this.files;

  for(var i = 0; i < archivos.length; i++){

    /*=============================================
    Validar formatos de archivos
    =============================================*/

    if( archivos[i]["type"] != "image/jpeg" &&
      archivos[i]["type"] != "image/png" &&
      archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" &&
      archivos[i]["type"] != "application/vnd.ms-excel" &&
      archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
      archivos[i]["type"] != "application/msword" &&
      archivos[i]["type"] != "application/pdf"){

      $(".subirAdjuntos2").val("");

      swal({
            title: "Error al subir los Archivos",
            text: "¡El formato de los archivos no es correcto, debe ser: JPG, PNG, EXCEL, WORD o PDF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

          return;

    }else if(archivos[i]["size"] > 2000000){

      /*=============================================
      Validar el tamaño de los archivos
      =============================================*/

      $(".subirAdjuntos2").val("");

      swal({
            title: "Error al subir los Archivos",
            text: "¡Los Archivos no deben pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });

          return;

    }else{

      multiplesArchivos2(archivos[i]);

    }

  }

})

var archivosTemporales2 = [];

function multiplesArchivos2(archivo){

  datosArchivo = new FileReader;
  datosArchivo.readAsDataURL(archivo);

  $(datosArchivo).on("load", function(event){

    var rutaArchivo = event.target.result;


    if(archivo["type"] == "image/jpeg" || archivo["type"] == "image/png"){

      $(".Archivos22").append(`

      <li>
              <span class="mailbox-attachment-icon has-img"><img src="`+rutaArchivo+`" alt="Attachment"></span><br>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> `+archivo['name']+`</a>
                    <span class="mailbox-attachment-size">
                      `+archivo['size']+` Bytes
                      <a class="btn btn-default btn-xs pull-right quitarAdjunto2" temporal2><i class="fa fa-times"></i></a>
                    </span>
              </div>
            </li>

      `)
    }

    if(archivo["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || archivo["type"] == "application/vnd.ms-excel"){

      $(".Archivos22").append(`

       <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>`+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto2" temporal2><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

    }

    if(archivo["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || archivo["type"] == "application/msword"){

      $(".Archivos22").append(`

       <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> `+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto2" temporal2><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

    }


    if(archivo["type"] == "application/pdf"){

      $(".Archivos22").append(`

       <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> `+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto2" temporal2><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

    }

    if(archivosTemporales2.length != 0){

      archivosTemporales2 = JSON.parse($(".archivosTemporales2").val());

    }

    archivosTemporales2.push(rutaArchivo)


    $(".archivosTemporales2").val(JSON.stringify(archivosTemporales2));

  })

}

/*==============================================
Quitar archivo adjunto de la respuesta de ticket
==============================================*/

$(document).on("click", ".quitarAdjunto2", function(){

  var listaTemporales = JSON.parse($(".archivosTemporales2").val());

  var quitarAdjunto = $(".quitarAdjunto2");

  for(var i = 0; i < listaTemporales.length; i++){

    $(quitarAdjunto[i]).attr("temporal2", listaTemporales[i]);

    var quitarArchivo = $(this).attr("temporal2");

    if(quitarArchivo == listaTemporales[i]){

      listaTemporales.splice(i, 1);

      $(".archivosTemporales2").val(JSON.stringify(listaTemporales));

      $(this).parent().parent().parent().remove();

    }

  }


})


/*=============================================
SUBIENDO ARCHIVOS ADJUNTOS AL TICKET NUEVO
=============================================*/

$(".subirAdjuntos").change(function(){

	var archivos = this.files;

	for(var i = 0; i < archivos.length; i++){

		/*=============================================
		Validar formatos de archivos
		=============================================*/

		if( archivos[i]["type"] != "image/jpeg" &&
			archivos[i]["type"] != "image/png" &&
			archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" &&
			archivos[i]["type"] != "application/vnd.ms-excel" &&
			archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
			archivos[i]["type"] != "application/msword" &&
			archivos[i]["type"] != "application/pdf"){

			$(".subirAdjuntos").val("");

			swal({
	          title: "Error al subir los Archivos",
	          text: "¡El formato de los archivos no es correcto, debe ser: JPG, PNG, EXCEL, WORD o PDF!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else if(archivos[i]["size"] > 2000000){

			/*=============================================
			Validar el tamaño de los archivos
			=============================================*/

			$(".subirAdjuntos").val("");

			swal({
	          title: "Error al subir los Archivos",
	          text: "¡Los Archivos no deben pesar más de 2MB!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else{

			multiplesArchivos(archivos[i]);

		}

	}

})

var archivosTemporales = [];

function multiplesArchivos(archivo){

	datosArchivo = new FileReader;
	datosArchivo.readAsDataURL(archivo);

	$(datosArchivo).on("load", function(event){

		var rutaArchivo = event.target.result;


		if(archivo["type"] == "image/jpeg" || archivo["type"] == "image/png"){

			$(".mailbox-attachments").append(`

			<li>
              <span class="mailbox-attachment-icon has-img"><img src="`+rutaArchivo+`" alt="Attachment"></span><br>

              <div class="mailbox-attachment-info">
                <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> `+archivo['name']+`</a>
                    <span class="mailbox-attachment-size">
                      `+archivo['size']+` Bytes
                      <a class="btn btn-default btn-xs pull-right quitarAdjunto" temporal><i class="fa fa-times"></i></a>
                    </span>
              </div>
            </li>

			`)
		}

		if(archivo["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || archivo["type"] == "application/vnd.ms-excel"){

		 	$(".mailbox-attachments").append(`

		 	 <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>`+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto" temporal><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

		}

		if(archivo["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || archivo["type"] == "application/msword"){

		 	$(".mailbox-attachments").append(`

		 	 <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>`+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto" temporal><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

		}


		if(archivo["type"] == "application/pdf"){

		 	$(".mailbox-attachments").append(`

		 	 <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>`+archivo['name']+`</a>
                        <span class="mailbox-attachment-size">
                          `+archivo['size']+` Bytes
                          <a class="btn btn-default btn-xs pull-right quitarAdjunto" temporal><i class="fa fa-times"></i></a>
                        </span>
                  </div>
                </li>

            `);

		}

		if(archivosTemporales.length != 0){

			archivosTemporales = JSON.parse($(".archivosTemporales").val());

		}

		archivosTemporales.push(rutaArchivo)


		$(".archivosTemporales").val(JSON.stringify(archivosTemporales));

	})

}


/*=============================================
Quitar archivo adjunto del ticket nuevo
=============================================*/

$(document).on("click", ".quitarAdjunto", function(){

	var listaTemporales = JSON.parse($(".archivosTemporales").val());

	var quitarAdjunto = $(".quitarAdjunto");

	for(var i = 0; i < listaTemporales.length; i++){

		$(quitarAdjunto[i]).attr("temporal", listaTemporales[i]);

		var quitarArchivo = $(this).attr("temporal");

		if(quitarArchivo == listaTemporales[i]){

			listaTemporales.splice(i, 1);

			$(".archivosTemporales").val(JSON.stringify(listaTemporales));

			$(this).parent().parent().parent().remove();

		}

	}


})

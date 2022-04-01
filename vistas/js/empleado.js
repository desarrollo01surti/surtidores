/*=============================================
CARGAR LA TABLA DINÁMICA DE EMPLEADOS
=============================================*/
$('.tablaEmpleado').DataTable( {
    "ajax": "ajax/datatable-empleado.ajax.php",
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
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaFotoEmpleado").change(function () {

	var imagen = this.files[0];

	/*=============================================
		VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
		=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFotoEmpleado").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else if (imagen["size"] > 2000000) {

		$(".nuevaFotoEmpleado").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function (event) {

			var rutaImagen = event.target.result;

			$(".previsualizarEmpleado").attr("src", rutaImagen);

		})

	}
})


/*=============================================
EDITAR EMPLEADO
=============================================*/
$(".tablaEmpleado").on("click", ".btnEditarEmpleado", function(){

	var idEmpleado = $(this).attr("idEmpleado");

	var d = new FormData();
	d.append("idEmpleado", idEmpleado);

	$.ajax({

		url:"ajax/empleado.ajax.php",
		method: "POST",
		data: d,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

    //   console.log(respuesta);

			$("#editarEmpleado").val(respuesta["codigo"]);
			$("#editarNombre").val(respuesta["nombre"]);

			$("#editTipDoc").html(respuesta["tipodoc"]);
			$("#editTipDoc").val(respuesta["idtipodoc"]);

			$("#editTipDoc").val(respuesta["idtipodoc"]);
			$("#editarNroDoc").val(respuesta["nrodoc"]);
			$("#editarEmail").val(respuesta["correo"]);
			$("#editarTelefono").val(respuesta["telefono"]);

			$("#editArea").html(respuesta["area"]);
			$("#editArea").val(respuesta["idarea"]);

			$("#fotoActualEmpl").val(respuesta["foto"]);


			if(respuesta["foto"] != ""){

				$(".previsualizarEmpleado").attr("src", respuesta["foto"]);

			}else{

				$(".previsualizarEmpleado").attr("src", "vistas/img/usuarios/default/anonymous.png");
      
			}

		}

	});

})

/*=============================================
CARGAR LA TABLA DINÁMICA DE EMPRESAS
=============================================*/
$('.tablaEmpresas').DataTable( {
    "ajax": "ajax/datatable-empresa.ajax.php",
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
SUBIENDO LA FOTO DE LA EMPRESA
=============================================*/

$(".nuevaImgEmpresa").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		 $(".nuevaImgEmpresa").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

	     $(".nuevaImgEmpresa").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

			$(".previsualizarEmpresa").attr("src", rutaImagen);

  		})

  	}
})


/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablaEmpresas").on("click", ".btnEditarEmpresa", function (){

	var idEmpresa = $(this).attr("idEmpresa");
  console.log(idEmpresa);
	var d = new FormData();
	d.append("idEmp", idEmpresa);

	$.ajax({

		url: "ajax/empresa.ajax.php",
		method: "POST",
		data: d,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			// console.log(respuesta);

			$("#editarEmpresa").val(respuesta["codigo"]);
			$("#editarRUC").val(respuesta["ruc"]);
			$("#editarRazonSocial").val(respuesta["descripcion"]);

			$("#fotoActualEmp").val(respuesta["logo"]);


			if (respuesta["logo"] != "") {

				$(".previsualizarEmpresa").attr("src", respuesta["logo"]);

			} else {

				$(".previsualizarEmpresa").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}

		}

	});

})

$(document).ready(function(){

   recargarSucursales();

   $('#seleccionaEmpresa').change(function(){

      recargarSucursales();

   });

})


//LLENAR SUCURSALES SEGUN EMPRESA
function recargarSucursales(){

  var idEmpresa = $('#seleccionaEmpresa').val();

  var datos = new FormData();
  datos.append("idEmpresa", idEmpresa);

  $.ajax({
      url: "ajax/empresa.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

        $("#datacheck").html(respuesta);

      }

  })

}

/*=============================================
CARGAR LA TABLA DINÁMICA DE SUCURSALES
=============================================*/
$('.tablaSucursal').DataTable( {
    "ajax": "ajax/datatable-sucursal.ajax.php",
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
EDITAR SUCURSAL
=============================================*/
$(".tablaSucursal").on("click", ".btnEditarSucursal", function(){

	var idSucursal = $(this).attr("idSucursal");

	var da = new FormData();
	da.append("idSucursal", idSucursal);

	$.ajax({

		url:"ajax/sucursal.ajax.php",
		method: "POST",
		data: da,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

       console.log(respuesta);

			$("#editarSucursal").val(respuesta["codigo"]);
			$("#editarDescrip").val(respuesta["descripcion"]);

			$("#editSeleccEmpresa").html(respuesta["empresa"]);
			$("#editSeleccEmpresa").val(respuesta["idempresa"]);

		}

	});

})

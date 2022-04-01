/*=============================================
CARGAR LA TABLA DINÁMICA DE ROLES
=============================================*/
$('.tablaRoles').DataTable( {
   "ajax": "ajax/datatable-roles.ajax.php",
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
CARGAR LA TABLA DINÁMICA DE ASIGNACION DE ROLES
=============================================*/
$('.tablaAsignaRoles').DataTable( {
   "ajax": "ajax/datatable-rolesAsignado.ajax.php",
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

$(document).ready(function(){


  $('#seleccionarTrabajAreaAsignado').change(function(){

      recargarTrabajadoresAsignado();

   });

})

//LLENAR SUCURSALES SEGUN EMPRESA
function recargarTrabajadoresAsignado(){

  var idArea = $('#seleccionarTrabajAreaAsignado').val();

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
        $("#muestraTrabajadorAjaxAsignado").empty();
        $("#muestraTrabajadorAjaxAsignado").append(respuesta);

      }

  })

}

/*=============================================
EDITAR ROL
=============================================*/
$(".tablaRoles").on("click", ".btnEditarRol", function (){ 

	var idRol = $(this).attr("idRol");

  console.log(idRol);

	var data = new FormData();
    data.append("idRol", idRol);

	 $.ajax({
      url: "ajax/roles.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      global: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){

        $("#idRol").val(respuesta["id_rol"]);
        $("#editarRol").val(respuesta["nombre_rol"]);

      }
  })

  	
})

$(".tablaAsignaRoles").on("click",".btnQuitarAsignado", function(){

	 var idRolAsig = $(this).attr("idRolAsig");
	 var empleado = $(this).attr("empleado");

	swal({
        title: '¿Está seguro de quitar el rol asignado a '+empleado+'?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, quitar rol asignado!'
      	}).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=roles&idRolAsig="+idRolAsig;
        }

     })
     
})

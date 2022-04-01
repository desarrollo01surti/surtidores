/*=============================================
CARGAR LA TABLA DINÁMICA DE USUARIOS
=============================================*/

$('.tablaUsuario').DataTable( {
    "ajax": "ajax/datatable-usuario.ajax.php",
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
CARGAR LA TABLA DINÁMICA DE EMPLEADO USUARIOS
=============================================*/

$('.tablaEmpleadoUser').DataTable( {
    "ajax": "ajax/datatable-empleadouser.ajax.php",
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


$("#AddUsuarioNuevo").click(VerNuevoUsuario);

  function VerNuevoUsuario(){
  		$("#verAgregarUsuario").show();
  		$("#tablaUsuario").hide();
  	}


$("#btnAgregarEmpleado").click(function(e){

    		e.preventDefault();

    		var radioCheck = $("input[type=radio]:checked");
    		$("#nuevoidTrabajador").val(radioCheck.val());
    		$("#nuevoTrabajador").val(radioCheck.attr("nombre"));

        var idArea = radioCheck.attr("idarea");

        var datos = new FormData();
        datos.append("idArea", idArea);

        $.ajax({
            url: "ajax/usuario.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

              $("#seleccionaPerfil").html(respuesta);
              $("#seleccionaPerfil").prop('disabled', false);

            }

        })

    		$("#modalBuscarTrabajador").modal("hide");
    	});


var checkBoxSucursales = $(".sucursal");

/*=============================================
VALIDAR LAS SUCURSALES SELECCIONADAS
=============================================*/
function registroSucursal(){

		for(var i = 0; i < checkBoxSucursales.length; i++){

			if ($(checkBoxSucursales[i]).is(':checked') ) {

				$(checkBoxSucursales[i]).attr("activate", 1);

				crearDatosJsonCheckSucursal()

			}else{

				$(checkBoxSucursales[i]).attr("activate", 0);

				crearDatosJsonCheckSucursal()

			}


		}

  }

$('.sucursal').on('change', function() {

      for(var i = 0; i < checkBoxSucursales.length; i++){

        if ($(checkBoxSucursales[i]).is(':checked') ) {

          $(checkBoxSucursales[i]).attr("activate", 1);

          crearDatosJsonCheckSucursal()

        }else{

          $(checkBoxSucursales[i]).attr("activate", 0);

          crearDatosJsonCheckSucursal()

        }


      }

});

function crearDatosJsonCheckSucursal(){

  var datoSucursal = [];

  for(var i = 0; i < checkBoxSucursales.length; i++){

        if($(checkBoxSucursales[i]).attr("activo") == 1){

          datoSucursal.push({"id": $(checkBoxSucursales[i]).attr("idSucursal"),
                           "activo": $(checkBoxSucursales[i]).attr("activate"),
                           "nombre": $(checkBoxSucursales[i]).attr("nombre")})

            console.log(datoSucursal);


          $("#valorPermiso").val(JSON.stringify(datoSucursal));

      }else{

          datoSucursal.push({"id": $(checkBoxSucursales[i]).attr("idSucursal"),
                           "activo": $(checkBoxSucursales[i]).attr("activate"),
                           "nombre": $(checkBoxSucursales[i]).attr("nombre")})

            console.log(datoSucursal);

          $("#valorSucursal").val(JSON.stringify(datoSucursal));

      }



  }

}

$(".btnEditarUsuario").click(function(e){
    		e.preventDefault();

        var idUsuario = $(this).attr("idUsuario");

        var datos = new FormData();
      	datos.append("idUsuario", idUsuario);

        $.ajax({
            url: "ajax/usuario.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){


              $("#editarTrabajador").val(respuesta["nombre"]);
              $("#editarUsuario").val(respuesta["usuario"]);
              $("#editarPerfil").html(respuesta["perfil"]);
              $("#editarPerfil").val(respuesta["perfil"]);
              $("#fotoActual").val(respuesta["foto"]);

              $("#seleccionaPerfil").html(respuesta);
              $("#seleccionaPerfil").prop('disabled', false);

            }

        })

    		$("#modalBuscarTrabajador").modal("hide");
    	});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PERFILES
=============================================*/

$('.tablaPerfiles').DataTable( {
    "ajax": "ajax/datatable-perfiles.ajax.php",
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

var checkBoxAccess = $(".accesofrm");

$('.accesofrm').on('change', function() {

 ////MODIFICAR CON ERRORES AL QUITAR CHECK

      for(var i = 0; i < checkBoxAccess.length; i++){

        if ($(checkBoxAccess[i]).is(':checked') ) {

          $(checkBoxAccess[i]).attr("activo", 1);

          crearDatosJsonCheck()

        }else{

          $(checkBoxAccess[i]).attr("activo", 0);

          crearDatosJsonCheck()

        }


      }

});

function registroModuloAcceso(){

		for(var i = 0; i < checkBoxAccess.length; i++){

			if ($(checkBoxAccess[i]).is(':checked') ) {

				$().attr("activo", 1);

				crearDatosJsonCheck()

			}else{

				$(checkBoxAccess[i]).attr("activo", 0);

				crearDatosJsonCheck()

			}


		}

  }

function crearDatosJsonCheck(){

  var datoPerfil = [];

  for(var i = 0; i < checkBoxAccess.length; i++){

        if($(checkBoxAccess[i]).attr("activo") == 1){

          datoPerfil.push({"id": $(checkBoxAccess[i]).attr("moduid"),
                           "activo": $(checkBoxAccess[i]).attr("activo"),
                           "nombre": $(checkBoxAccess[i]).attr("nombre"),
                           "modulo": $(checkBoxAccess[i]).attr("modulo"),
                           "nombremod": $(checkBoxAccess[i]).attr("nombremod")})

           // console.log(datoPerfil);


          $("#valorPerfil").val(JSON.stringify(datoPerfil));

      }else{

          datoPerfil.push({"id": $(checkBoxAccess[i]).attr("moduid"),
                           "activo": $(checkBoxAccess[i]).attr("activo"),
                           "nombre": $(checkBoxAccess[i]).attr("nombre"),
                           "modulo": $(checkBoxAccess[i]).attr("modulo"),
                           "nombremod": $(checkBoxAccess[i]).attr("nombremod")})

           // console.log(datoPerfil);


          $("#valorPerfil").val(JSON.stringify(datoPerfil));

      }



  }

}

/*=============================================
EDITAR ACCESOS A MODULOS
=============================================*/
$(".tablaPerfiles").on("click", ".btnAccesoModulos", function(){

	var idPerfil = $(this).attr("idPerfil");

	var datos = new FormData();
	datos.append("idPerfil", idPerfil);

	$.ajax({
		  url: "ajax/perfil.ajax.php",
		  method: "POST",
      data: datos,
      cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

        $("#areaPerf").val(respuesta["area"]);
        $("#perfilDat").val(respuesta["perfil"]);
        $("#idP").val(respuesta["idperfil"]);


				var dat = new FormData();
				dat.append("idPer", respuesta["idperfil"]);

				$.ajax({
						url: "ajax/perfil.ajax.php",
						method: "POST",
						data: dat,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respue){

							$("#dataModCheck").html(respue);
							// console.log(respue);

						}

					})

        // window.location = "index.php?ruta=editar-accesos&idPerf="+idPerfil;

        //TENEMOS QUE RECUPERAR EL ID, PERFIL Y AREA PARA IMPRIMIR EN EL MODAL Y USARLO AL ACTUALIZAR

     	}

	})


})

/*=============================================
EDITAR ACCESOS A MODULOS
=============================================*/
// $(".tablaPerfiles").on("click", ".btnAccesoModulos", function(){
//
//       	var idPerfil = $(this).attr("idPerfil");
//
//         window.location = "index.php?ruta=editar-accesos&idPerf="+idPerfil;
//
// })

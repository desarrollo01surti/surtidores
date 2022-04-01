/*=============================================
EDITAR PERMISOS DE LOS USUARIOS
=============================================*/
$(".tablaPerfiles").on("click", ".btnAccesoPermisos", function(){

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

        $("#areaPe").val(respuesta["area"]);
        $("#perfilDa").val(respuesta["perfil"]);
        $("#idPe").val(respuesta["idperfil"]);


				var dat = new FormData();
				dat.append("idPer", respuesta["idperfil"]);

				$.ajax({
						url: "ajax/permiso.ajax.php",
						method: "POST",
						data: dat,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respue){

							$("#datacheck").html(respue);
							// console.log(respue);

						}

					})

        // window.location = "index.php?ruta=editar-accesos&idPerf="+idPerfil;

        //TENEMOS QUE RECUPERAR EL ID, PERFIL Y AREA PARA IMPRIMIR EN EL MODAL Y USARLO AL ACTUALIZAR

     	}

	})


})

var checkBoxPermisos = $(".permisos");

/*=============================================
VALIDAR LOS PERMISOS CUANDO GUARDEN SIN EDITAR NINGUN REGISTRO
=============================================*/
function registroPermiso(){

		for(var i = 0; i < checkBoxPermisos.length; i++){

			if ($(checkBoxPermisos[i]).is(':checked') ) {

				$(checkBoxPermisos[i]).attr("activo", 1);

				crearDatosJsonCheckPermiso()

			}else{

				$(checkBoxPermisos[i]).attr("activo", 0);

				crearDatosJsonCheckPermiso()

			}


		}

  }

$('.permisos').on('change', function() {

 ////MODIFICAR CON ERRORES AL QUITAR CHECK

      for(var i = 0; i < checkBoxPermisos.length; i++){

        if ($(checkBoxPermisos[i]).is(':checked') ) {

          $(checkBoxPermisos[i]).attr("activo", 1);

          crearDatosJsonCheckPermiso()

        }else{

          $(checkBoxPermisos[i]).attr("activo", 0);

          crearDatosJsonCheckPermiso()

        }


      }

});


function crearDatosJsonCheckPermiso(){

  var datoPermiso = [];

  for(var i = 0; i < checkBoxPermisos.length; i++){

        if($(checkBoxPermisos[i]).attr("activo") == 1){

          datoPermiso.push({"id": $(checkBoxPermisos[i]).attr("idAcces"),
                           "activo": $(checkBoxPermisos[i]).attr("activo"),
                           "nombre": $(checkBoxPermisos[i]).attr("nombre")})

           // console.log(datoPerfil);


          $("#valorPermiso").val(JSON.stringify(datoPermiso));

      }else{

          datoPermiso.push({"id": $(checkBoxPermisos[i]).attr("idAcces"),
                           "activo": $(checkBoxPermisos[i]).attr("activo"),
                           "nombre": $(checkBoxPermisos[i]).attr("nombre")})

           // console.log(datoPerfil);


          $("#valorPermiso").val(JSON.stringify(datoPermiso));

      }



  }

}

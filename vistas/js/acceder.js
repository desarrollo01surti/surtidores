/*=============================================
ACCEDER A SISTEMA
=============================================*/
$(".tablaAcceder").on("click", ".btnAcceder", function(){

	var idSucursal = $(this).attr("idSucursal");
  var idPerfil = $(this).attr("idPerfil");
  var idUsuario = $(this).attr("idUsuario");
	var nomSucur = $(this).attr("NomSucur");
  var usuario = $(this).attr("usuario");

	// var datos = new FormData();
	// datos.append("idSucursal", idSucursal);

	sessionStorage.setItem('idsucursal', idSucursal);
	sessionStorage.setItem('sucursal', nomSucur);
	sessionStorage.setItem('perfil', idPerfil);
	sessionStorage.setItem('usuario', usuario);
  sessionStorage.setItem('idUsuario', idUsuario);

	$('#SucursalPrinc').val(nomSucur);

  window.location = "inicio";

})

// /*=============================================
// ACCEDER A SISTEMA SUPERADMIN
// =============================================*/
// $(".tablaAcceder").on("click", ".btnAcceder", function(){
//
// 	var idSucursal = $(this).attr("idSucursal");
//   var idPerfil = $(this).attr("idPerfil");
//   var idUsuario = $(this).attr("idUsuario");
//
// 	var datos = new FormData();
// 	datos.append("idSucursal", idSucursal);
//   datos.append("idPerfil", idPerfil);
//   datos.append("idUsuario", idUsuario);
//
// 	$.ajax({
// 		  url: "ajax/acceder.ajax.php",
// 		  method: "POST",
//       data: datos,
//       cache: false,
//      	contentType: false,
//      	processData: false,
//      	success: function(respuesta){
//
//         console.log(respuesta);
//
//         window.location = "inicio";
//
//      	}
//
// 	})
//
//
// })

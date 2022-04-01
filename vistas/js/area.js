/*=============================================
EDITAR AREA
=============================================*/
$(".tablas").on("click", ".btnEditarArea", function(){

	var idArea = $(this).attr("idArea");

	console.log(idArea);

	var datos = new FormData();
	datos.append("idArea", idArea);

	$.ajax({
	    url: "ajax/area.ajax.php",
	 	method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

				console.log(respuesta);

     		$("#editarArea").val(respuesta["descripcion"]);
			$("#editarAcro").val(respuesta["acro"]);
			$("#idA").val(respuesta["idarea"]);

     	}

	})


})

/*=============================================
IMPRIMIR SURSA CCDG-001
=============================================*/

// $(".btnExportarCCDG").on("click", function(){
//
// 	// var codigoVen = $(this).attr("codigoVenta");
//
// 	window.open("vistas/modulos/clases/correctivo.php", "_blank");
//
// })

/*=============================================
IMPRIMIR SURSA CCDG-001 PDF
=============================================*/

$(".btnExportarCCDG").on("click", function(){

	// var codigoVen = $(this).attr("codigoVenta");
	var codigoVen = "002";

	window.open("extensiones/tcpdf/pdf/correctivoCCDG.php?codigo="+codigoVen, "_blank"); //enviando un parametro para utilizarlo y filtrar en correctivo.php

})

/*=============================================
IMPRIMIR SURSA CCCL-001 PDF
=============================================*/

$(".btnExportarCCCL").on("click", function(){

	// var codigoVen = $(this).attr("codigoVenta");
	var codigoVen = "002";

	window.open("extensiones/tcpdf/pdf/correctivoCCCL.php?codigo="+codigoVen, "_blank"); //enviando un parametro para utilizarlo y filtrar en correctivo.php

})

/*=============================================
IMPRIMIR SURSA CCGG-001 PDF
=============================================*/

$(".btnExportarCCGG").on("click", function(){

	// var codigoVen = $(this).attr("codigoVenta");
	var codigoVen = "002";

	window.open("extensiones/tcpdf/pdf/correctivoCCGG.php?codigo="+codigoVen, "_blank"); //enviando un parametro para utilizarlo y filtrar en correctivo.php

})

/*=============================================
IMPRIMIR SURSA CCUM-001 PDF
=============================================*/

$(".btnExportarCCUM").on("click", function(){

	// var codigoVen = $(this).attr("codigoVenta");
	var codigoVen = "002";

	window.open("extensiones/tcpdf/pdf/correctivoCCUM.php?codigo="+codigoVen, "_blank"); //enviando un parametro para utilizarlo y filtrar en correctivo.php

})

/*=============================================
IMPRIMIR SURSA CPOS-001 PDF
=============================================*/

$(".btnExportarCPOS").on("click", function(){

	// var codigoVen = $(this).attr("codigoVenta");
	var codigoVen = "002";

	window.open("extensiones/tcpdf/pdf/correctivoCPOS.php?codigo="+codigoVen, "_blank"); //enviando un parametro para utilizarlo y filtrar en correctivo.php

})

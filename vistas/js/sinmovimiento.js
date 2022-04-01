/*=============================================
CARGAR LA TABLA DINÁMICA DE MOVIMIENTOS DE IMPORTACION
=============================================*/

$('.tablaSinMovimiento').DataTable({
    "ajax": "ajax/datatable-sinmovimiento.ajax.php",
    "deferRender": true,
  	"stateSave": true,
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
			className: 'btn btn-success'
		},
		{
			extend: 'pdfHtml5',
			text: '<i class="fa fa-file-pdf-o"></i> ',
      orientation: 'landscape',
			titleAttr: 'Exportar a PDF',
			className: 'btn btn-danger'
		},
		{
			extend: 'print',
			text: '<i class="fa fa-print"></i> ',
			titleAttr: 'Imprimir',
			className: 'btn btn-info'
		},
	],
});

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#btn-daterange').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Un Año Atras'  : [moment().subtract(1,'year').startOf('year'), moment().subtract(1,'year').endOf('year')],
      'Dos Años Atras'  : [moment().subtract(2,'year').startOf('year'), moment().subtract(2,'year').endOf('year')],
      'Tres Años Atras'  : [moment().subtract(3,'year').startOf('year'), moment().subtract(3,'year').endOf('year')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#btn-daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-daterange span").html();

   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=sin-movimiento&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "sin-movimiento";

})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=sin-movimiento&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

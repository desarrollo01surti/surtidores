/*=============================================
CARGAR LA TABLA DINÁMICA DE MOVIMIENTOS DE IMPORTACION
=============================================*/
var table;
table = $('.tablaRepMovimientos').DataTable( {
    "ajax": "ajax/datatable-movimientoim.ajax.php",
    "deferRender": true,
  	"stateSave": true,
	"ordering": false,
	"bAutoWidth": false,
	"bInfo": false, 
	"bFilter": false,
	"aoColumns" : [ 
		{ sWidth: '30px' }, 
		{ sWidth: '80px' }, 
		{ sWidth: '100px' }, 
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } , 
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } , 
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } , 
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } , 
		{ sWidth: '20px' } ,
		{ sWidth: '20px' } ,
		{ sWidth: '30px' } ,
		{ sWidth: '30px' } ,  
		{ sWidth: '30px' } ,
		{ sWidth: '30px' } ,  
		{ sWidth: '20px' } , 
	],
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
    //SE CREA FILTRO DE DATOS SEGUN LO SOLICITADO (PROVEEDOR)
	initComplete: function () {
		this.api().columns([1]).every(function () {
			var column = this;
			var select = $('<select class="form-control input-lg-3"><option value="">TODOS</option></select>')
				.appendTo('#selectProve')
				.on('change', function () {
					var val = $.fn.dataTable.util.escapeRegex(
						$(this).val()
					);

					column
						.search(val ? '^' + val + '$' : '', true, false)
						.draw();
				});

			column.data().unique().sort().each(function (d, j) {
				select.append('<option value="' + d + '">' + d + '</option>')
			});
		});
	 }
});


//FILTRO DE BUSQUEDA EXTRA
// $("#iptCodigoProve").keyup(function(){
//      table.column($(this).data('index')).search(this.value).draw();
// })

// $("#iptFechaDesde, #iptFechaHasta").keyup(function(){
//      table.draw();
// })
//
// $.fn.dataTable.ext.search.push(
//
//   function(settings, data, dataIndex){
//
//     var fechaDes = parseFloat($("#iptFechaDesde").val());
//     var fechaHast = parseFloat($("#iptFechaHasta").val());
//
//     var colVenta = parseFloat(data[6]);
//
//     if ( (isNaN(fechaDes) && isNaN(fechaHast)) ||
//          (isNaN(fechaDes) && colVenta <= fechaHast) ||
//          (fechaDes <= colVenta && isNaN(fechaHast)) ||
//          (fechaDes <= colVenta && colVenta <= fechaHast))
//     {
//          return true;
//     }
//
//          return false;
//
//   }
//
// )

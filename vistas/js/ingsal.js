/*=============================================
CARGAR LA TABLA DINÁMICA DE INGRESOS Y SALIDAS
=============================================*/

$('.tablaIngresoSalida1').DataTable( {
    "ajax": "ajax/datatable-ingresosalida.ajax.php?bimestre=primero",
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
    //SE CREA FILTRO DE DATOS SEGUN LO SOLICITADO (PROVEEDOR)
	initComplete: function () {
		this.api().columns([2]).every(function () {
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

/*=============================================
CARGAR LA TABLA DINÁMICA DE INGRESOS Y SALIDAS
=============================================*/

$('.tablaIngresoSalida2').DataTable( {
    "ajax": "ajax/datatable-ingresosalida.ajax.php?bimestre=segundo",
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
    //SE CREA FILTRO DE DATOS SEGUN LO SOLICITADO (PROVEEDOR)
	initComplete: function () {
		this.api().columns([2]).every(function () {
			var column = this;
			var select = $('<select class="form-control input-lg-3"><option value="">TODOS</option></select>')
				.appendTo('#selectProve2')
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

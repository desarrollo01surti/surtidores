/* SideBar Menu */
$('.sidebar-menu').tree();

$(".tablas").DataTable({

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

/* iCheck */
$('.ColumnaCheck input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});

/* jQueryKnob */
$('.knob').knob();

//Colorpicker
$('.my-colorpicker').colorpicker();

  //Initialize Select2 Elements
  $('.select2').select2();

// /*=============================================
// CORRECCIÓN BOTONERAS OCULTAS BACKEND
// =============================================*/
//
// if(window.matchMedia("(max-width:767px)").matches){
//
// 	$("body").removeClass('sidebar-collapse');
//
// }else{
//
// 	$("body").addClass('sidebar-collapse');
// }

/*=============================================
ACTIVAR SIDEBAR
=============================================*/

// $(document).on("click", ".sidebar-menu li", function(){
//
// 	localStorage.setItem("botonera", $(this).children().attr("href"));
//
// })
//
// if(localStorage.getItem("botonera") == null){
//
// 	$(".sidebar-menu li").removeClass("active");
//
// 	$(".sidebar-menu li a[href='inicio']").parent().addClass("active")
//
// }else{
//
// 	$(".sidebar-menu li").removeClass("active");
//
// 	$("a[href='"+localStorage.getItem("botonera")+"']").parent().addClass("active")
//
// }
function AlertaStock(){

	swal({
		 title: "¡ALERTA!",
		 text: "¡El codigo 0010038091191 esta a punto de quedarse sin stock!",
		 type: "error",
		 confirmButtonText: "¡Cerrar!"
	 });

}

/*=============================================
MOSTRAR SUCURSAL
=============================================*/
$(document).ready(function(){
//var intevalo = setInterval(AlertaStock, 5000);
var sucurs = sessionStorage.getItem('sucursal');

// console.log(sucurs);

$('#SucursalPrinc').html(sucurs);

})



/*=============================================
BUSCAR PRODUCTO
=============================================*/
  $(".buscar").keyup(function() { //se crea la funcioin keyup
    var texto = $(this).val(); //se recupera el valor de la caja de texto y se guarda en la variable texto

		// console.log(texto);
	 //se guarda en una variable nueva para posteriormente pasarla a busqueda.php
		var datos = new FormData();
		datos.append("texto", texto);

    if (texto == '') { //si no tiene ningun valor la caja de texto no realiza ninguna accion
			$("#display").html("").hide();
      //ninguna acción
    } else {
      //pero si tiene valor entonces

      $.ajax({ //metodo ajax
				url: "ajax/acceder.ajax.php", //la url adonde se va a mandar la cadena a buscar
        type: "POST", //aqui puede  ser get o post
        data: datos,
        cache: false,
				contentType: false,
				processData: false,
        success: function(html) { //funcion que se activa al recibir un dato

					// console.log(html);
          $("#display").html(html).show(); // funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
        }
      });

    }
    return false;
  });


//GENERAR ALERTA CADA QUE SE REGISTRE UN TICKET O RECLAMO
// 	$('.alertaPrueba').click(function() {
//
// 	toastr.info('Are you the 6 fingered man?')
//
// });

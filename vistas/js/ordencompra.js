/*=============================================
CAMBIANDO LENGUAJE ESPAÑOL AL SELECT 2
=============================================*/
$("#seleccionarProdProv").select2({
			language: "es"
		});

// var screen = $('#loading-screen');
//   configureLoadingScreen(screen);


/*=============================================
 LLENAR COMBO DE PRODUCTOS AL ACCIONAR PROVEEDOR
=============================================*/
$("#seleccionarProveedor").change(function(){

	var idProv = $(this).val();

	var data = new FormData();
	data.append("idProv", idProv);

	$.ajax({
		url: "ajax/ordencompra.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (idProv != 0) {

				if (respuesta["telefono"] != "") {
					$("#telefono").html(respuesta["telefono"]);
				}else{
					$("#telefono").html("-");
				}

				if (respuesta["contacto"] != "") {
					$("#contacto").html(respuesta["contacto"]);
				}else{
					$("#contacto").html("-");
				}

				if (respuesta["email"] != "") {
					$("#correo").html(respuesta["email"]);
			}	else{
					$("#correo").html("-");
				}
			}else{
				$("#telefono").html("-");
				$("#contacto").html("-");
				$("#correo").html("-");
			}

			
			
		}

	})
	
     recargarProductosProv();
	 
})

/*=============================================
 FUNCION LLENAR COMBO DE PRODUCTOS SEGUN PROVEEDOR
=============================================*/
function recargarProductosProv(){

  var idProveedor = $('#seleccionarProveedor').val();

  var dat = new FormData();
  dat.append("idProveedor", idProveedor);

  $.ajax({
      url: "ajax/ordencompra.ajax.php",
      method: "POST",
      data: dat,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        
        $("#seleccionarProdProv").html(respuesta);

      }

  })

}

/*=============================================
//SELECCIONAR COMBO DE PRODUCTO
=============================================*/
$("#seleccionarProdProv").change(function(){
	
    var idProvProd = $('#seleccionarProdProv').val();

	var dataProd = new FormData();
  	dataProd.append("idProvProd", idProvProd);

    $.ajax({
		url: "ajax/ordencompra.ajax.php",
		method: "POST",
		data: dataProd,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			// VALIDAR TODOS LOS DOCUMENTOS BY ID
			$("#descripcion").val(respuesta["descripcion"]);	
			$("#nroparte").val(respuesta["cod_provprod"]);
			$("#moneda").val(respuesta["moneda"]);
			$("#precio").val(respuesta["precio"]);
			$("#ID_prod").val(respuesta["ID_prod"]);

			$("#btnAddProducto").attr("idProdu", idProvProd);

			

			if(idProvProd != 0){

 				$("#descripcion").prop('readonly',true);
				$("#nroparte").prop('readonly',true);
				$("#moneda").prop('readonly',true);
				$("#precio").prop('readonly',true);

			}else{

				$("#descripcion").prop('readonly',false);
				$("#nroparte").prop('readonly',false);
				$("#moneda").prop('readonly',false);
				$("#precio").prop('readonly',false);

			}
			

		}

    })
	 
})


/*======================================================
AGREGANDO PRODUCTOS A LA ORDEN DE COMPRA DESDE LA TABLA
=======================================================*/
var totalOrden = 0.00;
$("#btnAddProducto").click(function(){

	//VALIDAR CAMPOS VACIOS
	var vacio = validarVacios();
	
	if (vacio == true) {
		return;
	}

	//SE CAPTURAN LAS CANTIDADES
	var cantidad = $("#cantidad").val();
	var descripcion = $("#descripcion").val();
	var nroparte = $("#nroparte").val();
	var moneda = $("#moneda").val();
	var precio = $("#precio").val();
    var codprod = $("#ID_prod").val();
	var total = precio * cantidad;

	//SE ARMA EL ESQUEMA PARA LA TABLA
	var fila = "<tr><td class='text-center'>"+cantidad+"</td><td class='text-center'>"+codprod+"</td><td class='text-center'>"+nroparte+"</td><td class='text-center'>"+descripcion+"</td><td class='text-right'>"+precio+"</td><td class='text-right'>"+total.toFixed(2)+"</td><td class='text-center'><span class='btnEliminarProd text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Producto'><i class='fa fa-trash'></i></span></td></tr>";

    //SE IMPRIME EN LA TABLA
    var btn = document.createElement("TR");
   	btn.innerHTML=fila;
    document.getElementById("items").appendChild(btn);

    recalcularTotalFinal();

	//SE CIERRA EL MODAL
	$("#modalProductos").modal("hide");
	recargarProductosProv();
	limpiarCampos();
})

/*======================================================
QUITANDO PRODUCTOS DE LA TABLA
=======================================================*/
$('#tablaOrdenProdu').on('click' ,'.btnEliminarProd', function(){

	$(this).closest('tr').remove();
	recalcularTotalFinal();
	// itemProducto = itemProducto - 1;
})

function recalcularTotalFinal(){

    //SE SUMA LOS TOTALES
	 $('#tablaOrdenProdu tbody').find('tr').each(function (i, el) {
               
        totalOrden += parseFloat($(this).find('td').eq(5).text());
                
    });

	//SE IMPRIME EL TOTAL GENERAL
	document.getElementById("totalMonto").innerHTML = totalOrden.toFixed(2); 

	totalOrden = 0.00;

}

function limpiarCampos(){

		$("#descripcion").val("");	
		$("#nroparte").val("");
		$("#moneda").val("");
		$("#precio").val("");
		$("#ID_prod").val("");
		$("#cantidad").val("");

		$("#descripcion").prop('readonly',false);
		$("#nroparte").prop('readonly',false);
		$("#moneda").prop('readonly',false);
		$("#precio").prop('readonly',false);

}

function validarVacios(){

	if ($("#cantidad").val() === "") {
		
		swal({
            title: "Error",
            text: "¡La cantidad no puede ir vacia!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return true;
	}

	if ($("#descripcion").prop('readonly') == false) {

		swal({
            title: "Error",
            text: "¡La descripcion no puede ir vacia!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

		return true;

	}

	if ($("#nroparte").prop('readonly') == false) {

		swal({
            title: "Error",
            text: "¡El campo Numero de parte/Cod Proveedor no puede ir vacio!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

		return true;

	}

	if ($("#moneda").prop('readonly') == false) {

		swal({
            title: "Error",
            text: "¡El campo moneda no puede ir vacia!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

		return true;

	}

	if ($("#precio").prop('readonly') == false) {

		swal({
            title: "Error",
            text: "¡El campo precio no puede ir vacio!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

		return true;

	}

}

